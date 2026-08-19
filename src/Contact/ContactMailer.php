<?php

declare(strict_types=1);

namespace App\Contact;

use PHPMailer\PHPMailer\Exception as MailException;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Handles email delivery (SMTP / native mail / custom sender) and body building.
 *
 * Config keys: mail_driver, smtp_host, smtp_port, smtp_user, smtp_pass,
 *              smtp_encryption, smtp_auth, smtp_timeout, app_name,
 *              contact_from, mail_sender (callable, optional)
 */
final class ContactMailer implements MailerInterface
{
    public function __construct(private array $config) {}

    /**
     * Dispatches the email via the configured transport.
     *
     * @return array{ok: bool, reason: string, user_message: string}
     */
    public function send(
        string $to,
        string $subject,
        string $textBody,
        string $htmlBody,
        string $from,
        ?string $replyTo,
        array $data,
        string $eventId,
        string $requestId
    ): array {
        $customSender = $this->config['mail_sender'] ?? null;
        if (is_callable($customSender)) {
            $result = $customSender([
                'to'         => $to,
                'subject'    => $subject,
                'text_body'  => $textBody,
                'html_body'  => $htmlBody,
                'from'       => $from,
                'reply_to'   => $replyTo,
                'data'       => $data,
                'event_id'   => $eventId,
                'request_id' => $requestId,
            ]);

            if (!is_array($result) || !($result['ok'] ?? false)) {
                $err = is_array($result) ? (string) ($result['error'] ?? 'erro desconhecido') : 'erro desconhecido';
                return [
                    'ok'           => false,
                    'reason'       => 'mail_sender falhou: ' . $err,
                    'user_message' => 'Recebemos sua solicitação de agendamento, mas o envio de e-mail falhou no servidor. Entre em contato também pelo WhatsApp.',
                ];
            }

            return ['ok' => true, 'reason' => '', 'user_message' => ''];
        }

        if ($this->useSmtpDriver()) {
            if (!$this->isSmtpConfigured()) {
                return [
                    'ok'           => false,
                    'reason'       => 'SMTP selecionado, mas incompleto no .env',
                    'user_message' => 'Recebemos sua solicitação de agendamento, mas o SMTP está incompleto no servidor. Entre em contato também pelo WhatsApp.',
                ];
            }

            $smtpResult = $this->sendViaSmtp($to, $subject, $textBody, $htmlBody, $from, $replyTo);
            if (!$smtpResult['ok']) {
                return [
                    'ok'           => false,
                    'reason'       => 'SMTP falhou: ' . ($smtpResult['error'] ?? 'erro desconhecido'),
                    'user_message' => 'Recebemos sua solicitação de agendamento, mas o envio de e-mail falhou no SMTP. Entre em contato também pelo WhatsApp.',
                ];
            }

            return ['ok' => true, 'reason' => '', 'user_message' => ''];
        }

        if (!$this->canUseNativeMail()) {
            return [
                'ok'           => false,
                'reason'       => 'Transporte de email indisponível (sendmail_path inválido)',
                'user_message' => 'Recebemos sua solicitação de agendamento, mas o servidor de e-mail não está configurado. Entre em contato também pelo WhatsApp.',
            ];
        }

        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . $from,
        ];
        if ($replyTo !== null) {
            $headers[] = 'Reply-To: ' . $replyTo;
        }

        $sent = mail($to, $subject, $textBody, implode("\r\n", $headers));
        if (!$sent) {
            return [
                'ok'           => false,
                'reason'       => 'mail() retornou false',
                'user_message' => 'Recebemos sua solicitação de agendamento, mas o envio de e-mail falhou no servidor. Entre em contato também pelo WhatsApp.',
            ];
        }

        return ['ok' => true, 'reason' => '', 'user_message' => ''];
    }

    public function resolveFromAddress(): string
    {
        $from = (string) ($this->config['contact_from'] ?? '');
        if ($from !== '') {
            return $from;
        }

        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $host = preg_replace('/:\d+$/', '', (string) $host) ?? 'localhost';
        return 'no-reply@' . $host;
    }

    public function buildTextBody(
        string $eventId,
        string $requestId,
        string $submittedAt,
        array $data,
        string $origin
    ): string {
        $environmentLabel = $this->environmentMarkerLabel();
        $originHref = rtrim($origin, '/');
        $originLabel = $this->originDisplayLabel($origin);
        $originSummary = $originLabel;
        if ($originHref !== '' && $originHref !== $originLabel) {
            $originSummary .= ' (' . $originHref . ')';
        }

        $lines = [
            'NOVA SOLICITAÇÃO DE AGENDAMENTO',
            str_repeat('=', 34),
            'Protocolo: ' . $requestId,
            'ID do evento: ' . $eventId,
            'Data/Hora: ' . $submittedAt,
        ];

        if ($environmentLabel !== null) {
            $lines[] = 'Ambiente: ' . $environmentLabel;
        }

        $lines = array_merge($lines, [
            'Site: ' . $originSummary,
            '',
            'DADOS DE CONTATO',
            '- Nome: ' . $data['nome'],
            '- Telefone/WhatsApp: ' . $data['telefone'],
            '- Email: ' . ($data['email'] !== '' ? $data['email'] : '-'),
            '- Convênio/Observações: ' . ($data['empresa'] !== '' ? $data['empresa'] : '-'),
            '',
            'MOTIVO DA CONSULTA',
            str_repeat('-', 34),
            $data['mensagem'],
        ]);

        return implode("\n", $lines);
    }

    public function buildHtmlBody(
        string $eventId,
        string $requestId,
        string $submittedAt,
        array $data,
        string $origin,
        string $brandName
    ): string {
        $rawPhone = trim((string) ($data['telefone'] ?? ''));
        $rawEmail = trim((string) ($data['email'] ?? ''));
        $originHref = rtrim($origin, '/');
        $originLabel = $this->originDisplayLabel($origin);
        $environmentLabel = $this->environmentMarkerLabel();

        $name = htmlspecialchars((string) ($data['nome'] ?? '-'), ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars($rawPhone !== '' ? $rawPhone : '-', ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($rawEmail !== '' ? $rawEmail : '-', ENT_QUOTES, 'UTF-8');
        $notes = htmlspecialchars((string) (($data['empresa'] ?? '') !== '' ? $data['empresa'] : '-'), ENT_QUOTES, 'UTF-8');
        $message = nl2br(htmlspecialchars((string) ($data['mensagem'] ?? ''), ENT_QUOTES, 'UTF-8'));
        $safeEventId = htmlspecialchars($eventId, ENT_QUOTES, 'UTF-8');
        $safeRequestId = htmlspecialchars($requestId, ENT_QUOTES, 'UTF-8');
        $safeSubmittedAt = htmlspecialchars($submittedAt, ENT_QUOTES, 'UTF-8');
        $safeOriginHref = htmlspecialchars($originHref !== '' ? $originHref : $origin, ENT_QUOTES, 'UTF-8');
        $safeOriginLabel = htmlspecialchars($originLabel, ENT_QUOTES, 'UTF-8');
        $safeBrandName = htmlspecialchars($brandName, ENT_QUOTES, 'UTF-8');
        $logoPath = trim((string) ($this->config['mail_logo_light'] ?? 'assets/img/brand/jerssica-square-dark.png'));
        $logoUrl = $this->absoluteAssetUrl($logoPath, $origin);
        $safeLogoUrl = htmlspecialchars($logoUrl, ENT_QUOTES, 'UTF-8');
        $textColor = '#2f2229';
        $mutedColor = '#6e5361';
        $linkColor = '#7b4b59';
        $outerBackground = '#f9d3e5';
        $panelBackground = '#fff7fb';
        $panelBorder = '#e3b4c5';
        $headerBackground = '#fffafc';
        $cardBackground = '#fffafb';
        $cardBorder = '#efcfdb';
        $messageBackground = '#fdf0f6';
        $messageBorder = '#e6bfd0';
        $protocolBackground = '#7b4b59';
        $protocolAccent = '#f2c1d7';
        $protocolLabelColor = '#fde7f0';
        $replyButtonBackground = '#c85e88';
        $replyButtonText = '#ffffff';

        $normalizedWhatsapp = $this->resolveSupportWhatsappNumber((string) ($data['telefone'] ?? ''));
        $whatsMessage = rawurlencode('Olá! Recebemos sua solicitação de agendamento. Protocolo: ' . $requestId . '. Vamos continuar por aqui.');
        $whatsHref = $normalizedWhatsapp !== null ? 'https://wa.me/' . $normalizedWhatsapp . '?text=' . $whatsMessage : '#';
        $safeWhatsHref = htmlspecialchars($whatsHref, ENT_QUOTES, 'UTF-8');
        $replyHref = filter_var($rawEmail, FILTER_VALIDATE_EMAIL) ? 'mailto:' . $rawEmail : null;
        $phoneHref = $this->telephoneHref($rawPhone);
        $safeReplyHref = $replyHref !== null ? htmlspecialchars($replyHref, ENT_QUOTES, 'UTF-8') : null;
        $safePhoneHref = $phoneHref !== null ? htmlspecialchars($phoneHref, ENT_QUOTES, 'UTF-8') : null;
        $phoneHtml = $safePhoneHref !== null
            ? '<a href="' . $safePhoneHref . '" style="color:' . $linkColor . ';text-decoration:underline;font-weight:600;">' . $phone . '</a>'
            : $phone;
        $emailHtml = $safeReplyHref !== null
            ? '<a href="' . $safeReplyHref . '" style="color:' . $linkColor . ';text-decoration:underline;font-weight:600;">' . $email . '</a>'
            : $email;
        $environmentBadgeHtml = '';
        if ($environmentLabel !== null) {
            $safeEnvironmentLabel = htmlspecialchars($environmentLabel, ENT_QUOTES, 'UTF-8');
            $environmentBadgeHtml = '<div style="display:inline-block;margin-top:10px;padding:4px 10px;border-radius:999px;background:' . $protocolAccent . ';color:' . $linkColor . ';font-size:11px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;">' . $safeEnvironmentLabel . '</div>';
        }
        $replyButtonHtml = $safeReplyHref !== null
            ? '<tr><td style="padding:0 0 10px 0;"><a href="' . $safeReplyHref . '" style="display:block;width:100%;box-sizing:border-box;padding:12px 14px;background:' . $replyButtonBackground . ';color:' . $replyButtonText . ';text-decoration:none;border-radius:8px;font-size:14px;font-weight:700;text-align:center;">Responder por email</a></td></tr>'
            : '';

        return <<<HTML
<div style="background:{$outerBackground};padding:16px;font-family:Arial,sans-serif;color:{$textColor};">
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:680px;margin:0 auto;background:{$panelBackground};border:1px solid {$panelBorder};border-radius:12px;overflow:hidden;">
    <tr>
      <td style="padding:16px;background:{$headerBackground};color:{$textColor};border-bottom:1px solid {$panelBorder};">
        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;">
          <tr>
            <td style="width:72px;vertical-align:middle;">
              <img src="{$safeLogoUrl}" alt="{$safeBrandName}" style="width:56px;height:56px;object-fit:contain;display:block;">
            </td>
            <td style="vertical-align:middle;">
              <div style="font-size:20px;line-height:1.3;font-weight:800;">{$safeBrandName}</div>
            </td>
          </tr>
        </table>
        <div style="font-size:18px;line-height:1.3;font-weight:700;margin-top:10px;">Nova solicitação de agendamento</div>
        <div style="font-size:13px;color:{$mutedColor};margin-top:4px;">Contato recebido por <a href="{$safeOriginHref}" style="color:{$linkColor};text-decoration:underline;">{$safeOriginLabel}</a></div>
      </td>
    </tr>

    <tr>
      <td style="padding:16px;">
        <div style="margin-bottom:16px;padding:14px 16px;border-radius:10px;background:{$protocolBackground};border-left:6px solid {$protocolAccent};color:#ffffff;">
          <div style="font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:{$protocolLabelColor};font-weight:700;">Protocolo</div>
          <div style="margin-top:4px;font-size:22px;line-height:1.2;font-weight:800;font-family:Consolas,'Courier New',monospace;">{$safeRequestId}</div>
          {$environmentBadgeHtml}
        </div>

        <div style="font-size:13px;color:{$mutedColor};margin-bottom:14px;line-height:1.45;">
          <strong>ID:</strong> {$safeEventId}<br>
          <strong>Data/Hora:</strong> {$safeSubmittedAt}<br>
          <strong>Site:</strong> <a href="{$safeOriginHref}" style="color:{$linkColor};text-decoration:underline;">{$safeOriginLabel}</a>
        </div>

        <div style="margin-bottom:12px;padding:12px;border:1px solid {$cardBorder};border-radius:8px;background:{$cardBackground};">
          <div style="font-size:12px;color:{$mutedColor};text-transform:uppercase;letter-spacing:.04em;">Nome</div>
          <div style="font-size:15px;line-height:1.4;">{$name}</div>
        </div>

        <div style="margin-bottom:12px;padding:12px;border:1px solid {$cardBorder};border-radius:8px;background:{$cardBackground};">
          <div style="font-size:12px;color:{$mutedColor};text-transform:uppercase;letter-spacing:.04em;">Telefone/WhatsApp</div>
          <div style="font-size:15px;line-height:1.4;word-break:break-word;">{$phoneHtml}</div>
        </div>

        <div style="margin-bottom:12px;padding:12px;border:1px solid {$cardBorder};border-radius:8px;background:{$cardBackground};">
          <div style="font-size:12px;color:{$mutedColor};text-transform:uppercase;letter-spacing:.04em;">Email</div>
          <div style="font-size:15px;line-height:1.4;word-break:break-word;">{$emailHtml}</div>
        </div>

        <div style="margin-bottom:16px;padding:12px;border:1px solid {$cardBorder};border-radius:8px;background:{$cardBackground};">
          <div style="font-size:12px;color:{$mutedColor};text-transform:uppercase;letter-spacing:.04em;">Convênio/Observações</div>
          <div style="font-size:15px;line-height:1.4;">{$notes}</div>
        </div>

        <div style="font-size:14px;font-weight:700;margin-bottom:8px;">Motivo da consulta</div>
        <div style="padding:12px;border:1px solid {$messageBorder};border-radius:8px;background:{$messageBackground};line-height:1.6;font-size:14px;word-break:break-word;">
          {$message}
        </div>

        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="margin-top:16px;border-collapse:collapse;">
          {$replyButtonHtml}
          <tr>
            <td style="padding:0;">
              <a href="{$safeWhatsHref}" style="display:block;width:100%;box-sizing:border-box;padding:12px 14px;background:#16a34a;color:#ffffff;text-decoration:none;border-radius:8px;font-size:14px;font-weight:700;text-align:center;">Abrir WhatsApp</a>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>
HTML;
    }

    private function originDisplayLabel(string $origin): string
    {
        $host = (string) parse_url($origin, PHP_URL_HOST);
        if ($host !== '') {
            return preg_replace('/^www\./i', '', $host) ?? $host;
        }

        $normalizedOrigin = preg_replace('#^https?://#i', '', rtrim($origin, '/'));
        return $normalizedOrigin !== null && $normalizedOrigin !== '' ? $normalizedOrigin : $origin;
    }

    private function environmentMarkerLabel(): ?string
    {
        $appEnv = strtolower(trim((string) ($this->config['app_env'] ?? 'production')));
        if ($appEnv === '' || in_array($appEnv, ['prod', 'production'], true)) {
            return null;
        }

        return match ($appEnv) {
            'homolog', 'staging' => 'Homologação',
            'dev', 'development', 'local' => 'Desenvolvimento',
            'test', 'testing' => 'Teste',
            default => 'Ambiente: ' . ucfirst($appEnv),
        };
    }

    private function telephoneHref(string $rawPhone): ?string
    {
        $normalizedPhone = $this->normalizeWhatsappNumber($rawPhone);
        if ($normalizedPhone !== null) {
            return 'tel:+' . $normalizedPhone;
        }

        $digits = preg_replace('/\D+/', '', $rawPhone);
        if ($digits === '') {
            return null;
        }

        return 'tel:' . $digits;
    }

    private function absoluteAssetUrl(string $assetPath, string $origin): string
    {
        if ($assetPath === '') {
            return $origin . '/assets/img/brand/jerssica-square-dark.png';
        }

        if (preg_match('#^https?://#i', $assetPath) === 1) {
            return $assetPath;
        }

        $normalizedAsset = ltrim($assetPath, '/');
        $normalizedOrigin = rtrim($origin, '/');
        return $normalizedOrigin . '/' . $normalizedAsset;
    }

    private function normalizeWhatsappNumber(string $rawPhone): ?string
    {
        $digits = preg_replace('/\D+/', '', $rawPhone);
        if ($digits === '') {
            return null;
        }

        if (str_starts_with($digits, '55') && strlen($digits) >= 12) {
            return $digits;
        }

        if (strlen($digits) === 10 || strlen($digits) === 11) {
            return '55' . $digits;
        }

        return strlen($digits) >= 12 ? $digits : null;
    }

    private function resolveSupportWhatsappNumber(string $fallbackRawPhone): ?string
    {
        $configuredUrl = trim((string) ($this->config['whatsapp_url'] ?? ''));
        if ($configuredUrl !== '') {
            if (preg_match('#wa\.me/(\d{10,16})#', $configuredUrl, $matches) === 1) {
                return $matches[1];
            }
        }

        $configuredNumber = trim((string) ($this->config['app_whatsapp_number'] ?? ''));
        $normalizedConfigured = $this->normalizeWhatsappNumber($configuredNumber);
        if ($normalizedConfigured !== null) {
            return $normalizedConfigured;
        }

        return $this->normalizeWhatsappNumber($fallbackRawPhone);
    }

    private function useSmtpDriver(): bool
    {
        return strtolower(trim((string) ($this->config['mail_driver'] ?? 'mail'))) === 'smtp';
    }

    private function isSmtpConfigured(): bool
    {
        $host = trim((string) ($this->config['smtp_host'] ?? ''));
        $user = trim((string) ($this->config['smtp_user'] ?? ''));
        $pass = (string) ($this->config['smtp_pass'] ?? '');
        $port = (int) ($this->config['smtp_port'] ?? 0);
        return $host !== '' && $user !== '' && $pass !== '' && $port > 0;
    }

    private function sendViaSmtp(
        string $to,
        string $subject,
        string $textBody,
        string $htmlBody,
        string $from,
        ?string $replyTo
    ): array {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host     = (string) $this->config['smtp_host'];
            $mail->Port     = (int) $this->config['smtp_port'];
            $mail->SMTPAuth = (bool) $this->config['smtp_auth'];
            $mail->Username = (string) $this->config['smtp_user'];
            $mail->Password = (string) $this->config['smtp_pass'];
            $mail->Timeout  = (int) $this->config['smtp_timeout'];
            $mail->CharSet  = 'UTF-8';

            $enc = strtolower(trim((string) ($this->config['smtp_encryption'] ?? 'tls')));
            if ($enc === 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } elseif ($enc === 'tls') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            } else {
                $mail->SMTPSecure  = '';
                $mail->SMTPAutoTLS = false;
            }

            $mail->setFrom($from, (string) ($this->config['app_name'] ?? 'Clínica Médica'));
            $mail->addAddress($to);
            if ($replyTo !== null) {
                $mail->addReplyTo($replyTo);
            }

            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->AltBody = $textBody;
            $mail->isHTML(true);

            $mail->send();
            return ['ok' => true];
        } catch (MailException $e) {
            return ['ok' => false, 'error' => $e->getMessage()];
        }
    }

    private function canUseNativeMail(): bool
    {
        if (\PHP_OS_FAMILY === 'Windows') {
            return true;
        }

        $sendmailPath = trim((string) ini_get('sendmail_path'));
        if ($sendmailPath === '') {
            return false;
        }

        $parts  = preg_split('/\s+/', $sendmailPath);
        $binary = $parts[0] ?? '';
        return $binary !== '' && is_executable($binary);
    }
}
