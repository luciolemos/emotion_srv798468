<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;

final class CreateLandingScriptTest extends TestCase
{
    private string $rootPath;

    protected function setUp(): void
    {
        $this->rootPath = sys_get_temp_dir() . '/create-landing-' . bin2hex(random_bytes(4));
    }

    protected function tearDown(): void
    {
        $this->removeDirectory($this->rootPath);
    }

    public function testCreateLandingListsPresetSlugs(): void
    {
        $script = dirname(__DIR__) . '/scripts/create-landing.sh';
        $command = 'bash ' . escapeshellarg($script) . ' --list-presets';

        exec($command, $output, $exitCode);
        $text = implode("\n", $output);

        self::assertSame(0, $exitCode, $text);
        self::assertStringContainsString('slug', $text);
        self::assertStringContainsString('psicologia', $text);
        self::assertStringContainsString('warm', $text);
        self::assertStringContainsString('MedicalBusiness', $text);
    }

    public function testCreateLandingUsesSlugContentAndPrunesOtherNiches(): void
    {
        $projectRoot = dirname(__DIR__);
        $target = $this->rootPath . '/psicologia';
        $script = $projectRoot . '/scripts/create-landing.sh';

        $command = 'bash ' . escapeshellarg($script)
            . ' psicologia --target ' . escapeshellarg($target);

        exec($command, $output, $exitCode);

        self::assertSame(0, $exitCode, implode("\n", $output));
        $createOutput = implode("\n", $output);
        self::assertStringContainsString('composer install --no-dev --optimize-autoloader', $createOutput);
        self::assertStringContainsString('chown -R www-data:www-data', $createOutput);
        self::assertStringContainsString('audit-apache-subdir-vhost.sh', $createOutput);
        self::assertFileExists($target . '/config/content/landing.php');
        self::assertFileExists($target . '/config/content/psicologia.php');
        self::assertFileExists($target . '/.github/workflows/ci.yml');
        self::assertFileExists($target . '/phpcs.xml.dist');
        self::assertFileExists($target . '/phpstan.neon');
        self::assertStringContainsString('APP_CONTENT_FILE="psicologia"', (string) file_get_contents($target . '/.env'));
        self::assertStringContainsString('APP_SLUG="psicologia"', (string) file_get_contents($target . '/.env'));
        self::assertStringContainsString('APP_WHATSAPP_NUMBER="557184005128"', (string) file_get_contents($target . '/.env'));
        self::assertStringContainsString('APP_WHATSAPP_MESSAGE="Oi, Jersika! Gostaria de agendar um atendimento psicológico."', (string) file_get_contents($target . '/.env'));
        self::assertStringContainsString('location-map-banner', (string) file_get_contents($target . '/views/pages/home.twig'));
        self::assertStringContainsString('location-map-banner', (string) file_get_contents($target . '/public/assets/css/landing.css'));
        self::assertStringContainsString("'location' => [", (string) file_get_contents($target . '/config/content/landing.php'));
        self::assertStringContainsString("'map_embed_url' => 'https://maps.google.com/maps?", (string) file_get_contents($target . '/config/content/landing.php'));
        self::assertStringContainsString('phpcs:', (string) file_get_contents($target . '/.github/workflows/ci.yml'));
        self::assertStringContainsString('phpstan:', (string) file_get_contents($target . '/.github/workflows/ci.yml'));
        self::assertStringContainsString('phpunit:', (string) file_get_contents($target . '/.github/workflows/ci.yml'));
        self::assertStringContainsString('visual-tests:', (string) file_get_contents($target . '/.github/workflows/ci.yml'));
        self::assertFileExists($target . '/public/assets/img/hero/jersika_carvalho-desktop-640.webp');
        self::assertFileExists($target . '/public/assets/img/hero/jersika_carvalho-mobile-640.webp');
        self::assertFileExists($target . '/public/assets/img/social/psicologia-og.jpg');
        self::assertFileDoesNotExist($target . '/public/assets/img/hero/medico-desktop-640.webp');

        $validateCommand = escapeshellarg(PHP_BINARY)
            . ' ' . escapeshellarg($target . '/scripts/validate-landing-content.php')
            . ' --project-root ' . escapeshellarg($target)
            . ' --content psicologia'
            . ' --slug psicologia'
            . ' --strict';

        exec($validateCommand, $validateOutput, $validateExitCode);

        self::assertSame(0, $validateExitCode, implode("\n", $validateOutput));
    }

    private function removeDirectory(string $path): void
    {
        if (!is_dir($path)) {
            return;
        }

        $items = scandir($path);
        if ($items === false) {
            return;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $fullPath = $path . '/' . $item;
            if (is_dir($fullPath)) {
                $this->removeDirectory($fullPath);
                continue;
            }

            @unlink($fullPath);
        }

        @rmdir($path);
    }
}
