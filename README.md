Email: contato@jersikacarvalhopsicologa.com
# Landing Médica (Psicologia, Pediatria, Odontologia)
Uma landing page é uma página criada com o objetivo de levar o visitante a realizar uma ação específica, como comprar um produto, solicitar um orçamento, preencher um formulário, entrar em contato ou se cadastrar em algum serviço. Diferente de um site tradicional, que normalmente possui várias páginas e diferentes caminhos de navegação, a landing page é mais simples, direta e focada na conversão do usuário. Sua principal finalidade é transformar visitantes em clientes ou potenciais clientes, sendo muito utilizada em campanhas de marketing digital, anúncios em redes sociais e divulgação de produtos ou serviços.

## Produto

Protótipo de landing page para serviços de saúde, pronto para derivar projetos como `/medico`, `/pediatria`, `/odontologia` e outros subdiretórios.

## Para quem tem interesse em adquirir o nicho Psicologia

Esta é uma apresentação simples para quem quer colocar no ar uma página de captação específica para Psicologia.

- O que é uma landing page: é uma página focada em um único objetivo — neste caso, captar contatos qualificados de pacientes interessados em atendimento psicológico. Tudo é pensado para clareza, confiança e ação (agendar ou falar no WhatsApp).
- O que você recebe: um site de nicho “Pronto para Converter” de Psicologia, com textos, imagens e seções já organizadas para sua clínica/Consultório, funcionando em servidores comuns de hospedagem compartilhada e preparado para crescer junto com o negócio.

### Como a landing de Psicologia está montada

- Não é um único arquivo estático: apesar do nome “landing page”, aqui usamos uma aplicação com organização profissional (MVC e roteamento) para facilitar manutenção e crescimento.
- Conteúdo do nicho: `config/content/psicologia.php` concentra os textos, chamadas e rótulos usados na página.
- Templates: o layout é montado em partes com Twig (por exemplo `views/pages/home.twig`, `views/partials/navbar.twig` e `views/partials/footer.twig`).
- Rotas: a navegação é simples e direta — a página principal e o envio do formulário ficam em `routes/web.php`.
- Controlador: a lógica de exibição e do formulário está em `src/Controllers/HomeController.php`.
- Imagens: ficam em `public/assets/img/` com versões otimizadas para celular e desktop.

### Objetivo de cada seção (explicado de forma didática)

- Hero (cabeçalho com destaque): apresenta sua proposta de valor de forma clara, com botões de ação (“Agendar consulta” e “Ver atendimentos”) e selos de confiança.
- Para quem é (momentos/situações): lista rápida de situações comuns em que o atendimento psicológico ajuda, conectando com a necessidade do paciente.
- Serviços: mostra as frentes de atendimento (ex.: terapia individual, de casal, avaliação, acompanhamento), com ícones e textos curtos.
- Como funciona: explica o passo a passo do agendamento e do primeiro contato, reduzindo dúvidas e inseguranças.
- Estrutura/diferenciais: reforça pontos fortes do consultório (acolhimento, organização, retorno, privacidade), ajudando na decisão.
- Chamada final (CTA): convida o visitante a solicitar o agendamento ou falar no WhatsApp, com pontos de apoio (ex.: horário, confirmação, canais de retorno).
- Formulário de agendamento: formulário em 2 etapas para captar nome, telefone/WhatsApp, e-mail e motivo da consulta, com mensagem de confirmação.
- Dúvidas frequentes (FAQ): antecipa respostas sobre convênios, horários, primeira consulta, retorno, políticas etc.
- Rodapé e contato: links úteis, identidade e política de privacidade; atalho fixo para WhatsApp.

### Vantagens do produto

- Pronto para publicar: funciona em hospedagem compartilhada (PHP 8.3+), sem necessidade de servidores dedicados.
- Rápido e otimizado: imagens WebP, pré-carregamento da imagem principal e CSS leve para tempo de carregamento curto.
- SEO técnico preparado: títulos, descrições, Open Graph/Twitter Card e dados estruturados (JSON-LD) configuráveis para nichos.
- Formulário seguro e com anti-spam: proteção CSRF, campo honeypot, reCAPTCHA v3 e limitador de tentativas por IP.
- Entrega confiável de leads: envio de e-mail com fallback em arquivo local caso o SMTP não esteja configurado, além de registro operacional de eventos.
- Visual personalizável: paletas de cores e tipografia por perfil, mantendo consistência e legibilidade.

### Pronta para escalar com o seu negócio

- Arquitetura em camadas (MVC + Twig + roteamento) facilita ajustes e evolução sem “quebrar” a página.
- Configuração por ambiente (`.env`) e por nicho (`config/content/psicologia.php`) para criar variações com rapidez.
- Estrutura modular: cabeçalho, seções, formulário e rodapé são componentes reaproveitáveis — ideal para crescer para outras especialidades.

Se você só quer “entrar no ar”, basta configurar os dados básicos (nome da clínica, WhatsApp e e-mail de recebimento) e publicar. Quando seu consultório crescer, a mesma base suporta novos serviços, ajustes de conteúdo e integrações adicionais sem precisar refazer o site.

### Checklist de personalização (Psicologia)

1) Identidade e dados básicos
- Ajuste as chaves no `.env` (use o arquivo de exemplo `.env.example`): `APP_NAME`, `APP_MARK`, `APP_PAGE_TITLE`, `APP_SLUG=psicologia`, `APP_CONTENT_FILE=psicologia`, `APP_BASE` (ex.: `/psicologia`), redes sociais (`FACEBOOK_URL`, `INSTAGRAM_URL`, `X_URL`), e WhatsApp (`APP_WHATSAPP_NUMBER`, `APP_WHATSAPP_MESSAGE`).
- Configure `CONTACT_TO` com o e-mail que vai receber os leads e `CONTACT_FROM` com um remetente válido do seu domínio.

2) Conteúdo do nicho
- Atualize títulos e textos em `config/content/psicologia.php` (SEO, chamadas, serviços, FAQ e mensagens do formulário).

3) Imagens
- Substitua os arquivos em `public/assets/img/hero/`:
	- `psicologia-640.webp`, `psicologia-960.webp`, `psicologia-1896.webp`, `psicologia-mobile-640.webp`.
- Atualize a imagem social em `public/assets/img/social/psicologia-og.jpg`.
- Se desejar, troque o logotipo/ícone em `public/assets/img/psicologia-mark.svg`.

4) Revisão final
- Rode os testes e checagens locais: `composer test`, `bash scripts/run-tests.sh`, e `php scripts/validate-landing-content.php --content psicologia --slug psicologia`.

### Guia de publicação (hospedagem compartilhada)

Pré-requisitos: PHP 8.3+ habilitado no painel e acesso ao gerenciador de arquivos/FTP. Idealmente, a pasta pública do site (ex.: `public_html/`) deve apontar para o diretório `public/` deste projeto.

Passo a passo (rota recomendada: subdiretório `/psicologia`):
1) Envio de arquivos
- Faça upload de todo o projeto para uma pasta fora da raiz pública (ex.: `~/apps/psicologia`).
- Aponte o subdomínio/caminho público para `~/apps/psicologia/public` (se o painel permitir escolher o Document Root).
- Alternativa quando não é possível mudar o Document Root: crie um subdiretório público (ex.: `public_html/psicologia`) e copie apenas o conteúdo de `public/` para lá. Nesse caso, mantenha `APP_BASE=/psicologia` e garanta que `index.php` consiga resolver os caminhos relativos (já está preparado para isso).

2) Configuração do ambiente
- Copie `.env.example` para `.env` e ajuste: `APP_NAME`, `APP_BASE`, `APP_CANONICAL_URL` (URL pública final), `CONTACT_TO`, `MAIL_DRIVER` e variáveis `SMTP_*` do seu provedor de e-mail.
- Para a produção deste projeto em `https://jersikacarvalhopsicologa.com/`, use `.env.production.example` como base e copie o resultado para o `.env` na raiz do app publicado.
- Em produção real, habilite reCAPTCHA v3: `RECAPTCHA_ENABLED=true` e preencha `RECAPTCHA_SITE_KEY` e `RECAPTCHA_SECRET_KEY` do seu domínio.

3) Permissões e cache
- Após publicar ou atualizar templates, execute a limpeza do cache do Twig. Se tiver acesso SSH:

```bash
bash scripts/deploy-post-update.sh --project-root "$PWD" --skip-chown
```

- Sem SSH, exclua manualmente os arquivos de `storage/cache/twig/` mantendo o `.gitkeep`.

4) Verificação rápida (opcional)
- Rode os smoke tests no ambiente publicado se SSH estiver disponível:

```bash
bash scripts/smoke-frontend.sh --url "https://seudominio.com.br/psicologia/"
bash scripts/smoke-contact.sh  --url "https://seudominio.com.br/psicologia/"
```

Deploy SSH manual com checkout único em `/var/www/emotion`:

- Homologação: `git checkout homolog && git pull --ff-only && bash scripts/deploy-homolog-ssh.sh`
- Produção: `git checkout main && git pull --ff-only && bash scripts/deploy-prod-ssh.sh`
- Retorno ao desenvolvimento: `git checkout emotion`

Neste host específico da Hostinger, não existe `~/apps/.../current`. A homologação usa o vhost `~/domains/homolog.jersikacarvalhopsicologa.com/public_html` e a produção usa `~/domains/jersikacarvalhopsicologa.com/public_html`. Os scripts sincronizam o app completo para esses diretórios reais, enviam `public/assets/` e `.htaccess` para o docroot do respectivo domínio, e executam o pós-update no servidor remoto.

5) Checklist final
- Página abre rápido no celular, imagens carregam em WebP.
- Formulário envia e chega no e-mail configurado em `CONTACT_TO`.
- WhatsApp abre com a mensagem inicial correta.
- Meta tags (título/descrição/imagem) aparecem ao compartilhar o link.

## Requisitos

- PHP 8.3 ou 8.4
- Composer
- Node.js somente para testes E2E com Playwright

## Configuração

Copie `.env.example` para `.env` e ajuste:

- `APP_NAME`: nome público da clínica.
- `APP_PAGE_TITLE`: título da página.
- `APP_SLUG`: identificador curto da landing, por exemplo `medico`, `pediatria` ou `odontologia`.
- `APP_REQUEST_PREFIX`: prefixo dos protocolos, por exemplo `MED`, `PED`, `ODO`.
- `APP_CONTENT_FILE`: arquivo de conteúdo em `config/content/` sem a extensão `.php`; use `landing` para uma landing por repositório.
- `APP_CANONICAL_URL`: URL pública canônica da landing, com domínio e subcaminho; quando vazio, o app deriva do host da requisição.
- `APP_BASE`: subcaminho de publicação, por exemplo `/medico`, `/pediatria` ou `/odontologia`.
- `APP_NOINDEX`: use `true` em homologação pública ou URLs que não devem ser indexadas; o app envia `X-Robots-Tag` e `<meta name="robots" content="noindex, nofollow">`.
- `APP_PALETTE`: paleta padrão da landing (`blue`, `red`, `emerald`, `amber` ou `violet`).
- `APP_SHOW_PALETTE_SELECTOR`: use `true` em catálogo/demo para mostrar o seletor de cores; mantenha `false` na landing final.
- `APP_SHOW_TESTIMONIALS`: use `false` para ocultar a seção de depoimentos sem remover o código; use `true` quando quiser reativá-la.
- `APP_JOURNEY_LAYOUT`: use `panels` para exibir os painéis visuais da jornada ou `text` para reativar o layout editorial anterior.
- `FACEBOOK_URL`: link oficial do Facebook.
- `APP_WHATSAPP_NUMBER` e `APP_WHATSAPP_MESSAGE`: número e mensagem inicial usados para gerar o link oficial de WhatsApp.
- `WHATSAPP_URL`: fallback legado de WhatsApp quando `APP_WHATSAPP_NUMBER` estiver vazio.
- `CONTACT_TO` e `CONTACT_FROM`: emails usados pelo formulário.
- Configurações `SMTP_*`, se `MAIL_DRIVER="smtp"`.
- `LEAD_LOG_RETENTION_DAYS`: retenção dos logs de leads e fallback em `storage/`.
- `LEAD_LOG_HASH_SALT`: sal usado para pseudonimizar IP, user-agent e hashes operacionais; defina um valor privado no `.env` real.
- `RECAPTCHA_ENABLED`: mantenha `false` em homologação ou domínios ainda não cadastrados no Google; use `true` apenas no `.env` real de produção.
- `RECAPTCHA_SITE_KEY`, `RECAPTCHA_SECRET_KEY`, `RECAPTCHA_MIN_SCORE`, `RECAPTCHA_ALLOWED_HOSTNAME` e `RECAPTCHA_ACTION`: configuram o reCAPTCHA v3 do formulário; mantenha os segredos somente no `.env` não versionado da produção.

O arquivo `.env` não é versionado. Não coloque chaves secretas de SMTP/reCAPTCHA em `.env.example`, README ou arquivos de backup versionados.

## Fluxo de ambientes

Fluxo Git recomendado para este projeto:

- `emotion`: desenvolvimento em `https://srv798468.hstgr.cloud/emotion/`
- `homolog`: homologação em `https://homolog.jersikacarvalhopsicologa.com/`
- `main`: produção em `https://jersikacarvalhopsicologa.com/`

Promoção:

1. Desenvolva e valide na branch `emotion`.
2. Faça merge de `emotion` para `homolog` e publique a homologação.
3. Após validação, faça merge de `homolog` para `main`.

Use um único checkout local em `/var/www/emotion`. O fluxo esperado é trocar a branch nesse diretório conforme a etapa (`emotion`, `homolog`, `main`) e manter o `.env` correto apenas no servidor de cada ambiente.

Configuração sugerida nos `.env` publicados por ambiente:

- Desenvolvimento (`emotion`): `APP_BASE="/emotion"`, `APP_CANONICAL_URL="https://srv798468.hstgr.cloud/emotion/"`, `APP_ENV="dev"`, `APP_NOINDEX="true"`, `RECAPTCHA_ENABLED="false"`.
- Homologação (`homolog`): `APP_BASE=""`, `APP_CANONICAL_URL="https://homolog.jersikacarvalhopsicologa.com/"`, `APP_ENV="staging"`, `APP_NOINDEX="true"`, `RECAPTCHA_ENABLED="false"`.
- Produção (`main`): `APP_BASE=""`, `APP_CANONICAL_URL="https://jersikacarvalhopsicologa.com/"`, `APP_ENV="production"`, `APP_NOINDEX="false"`, `RECAPTCHA_ENABLED="true"`.

Cada ambiente deve ter seu próprio `.env` no servidor. Não compartilhe o mesmo arquivo entre desenvolvimento, homologação e produção.
Para localhost na raiz, use `bash scripts/dev-local.sh`; ele força temporariamente `APP_BASE=""` e `APP_ENV="dev"` e restaura o `.env` ao encerrar.

## Execução Local

```bash
composer install
bash scripts/dev-local.sh
```

Abra `http://127.0.0.1:8000/`.

## Criando uma nova landing

1. Copie este projeto para o novo diretório, por exemplo `/var/www/pediatria`.
2. Remova a identidade Git herdada se o destino for outro repositório.
3. Ajuste `.env`: `APP_BASE`, nome público, links sociais, WhatsApp, SMTP e reCAPTCHA.
4. Troque textos no arquivo ativo de `config/content/` e imagens em `public/assets/img/hero/` e `public/assets/img/social/`.
5. Rode `composer test` e `bash scripts/run-tests.sh --url "http://127.0.0.1:8000/"`.

Também há um gerador para criar uma cópia limpa do protótipo:

```bash
bash scripts/create-landing.sh --list-presets
bash scripts/create-landing.sh pediatria --name "Clínica Pediátrica" --mark P --palette emerald --request-prefix PED
```

Quando existir um arquivo de nicho com o mesmo slug, como `config/content/pediatria.php`, o gerador define `APP_CONTENT_FILE="pediatria"` automaticamente, mantém os assets específicos desse nicho e remove variações de nichos não usados na cópia final.

## Testes

```bash
composer test
npx playwright test
```

Os scripts em `scripts/` também mantêm smoke tests de paleta, formulário e frontend para ambientes publicados.

Valide conteúdo, SEO e assets antes de publicar:

```bash
php scripts/validate-landing-content.php
php scripts/validate-landing-content.php --content pediatria --slug pediatria
php scripts/validate-landing-content.php --content odontologia --slug odontologia
php scripts/validate-landing-content.php --content veterinaria --slug veterinaria
bash scripts/audit-generated-landings.sh
```

`scripts/audit-generated-landings.sh` cria cópias temporárias para os presets, confere `.env`, conteúdo ativo, assets obrigatórios e ausência de arquivos herdados de outros nichos. O `quality-gate` roda essa auditoria automaticamente.

## Privacidade e retenção

`lead-events.log` registra eventos operacionais sem nome, telefone, email, mensagem, IP ou user-agent em texto claro. Quando o e-mail falha, `contatos-fallback.log` guarda o contato completo para recuperação manual e deve ser retido por pouco tempo.

Limpeza manual ou por cron:

```bash
php scripts/prune-lead-data.php --days 30
php scripts/prune-lead-data.php --days 30 --dry-run
```

## Conteúdo

O conteúdo principal está em:

- `config/content/landing.php`
- `views/partials/navbar.twig`
- `views/partials/footer.twig`
- `public/assets/img/`

Para protótipos com mais de uma variação no mesmo repositório, crie outro arquivo em `config/content/`, por exemplo `config/content/pediatria.php`, e aponte `APP_CONTENT_FILE="pediatria"`. Quando `APP_CONTENT_FILE` não é informado, o app tenta `APP_SLUG` e depois volta para `landing`.

A seção `seo` em `config/content/landing.php` controla título, descrição, Open Graph, Twitter Card e JSON-LD. Para novos nichos, ajuste principalmente `seo.schema.type`, por exemplo `MedicalClinic`, `Dentist` ou `VeterinaryCare`, além de imagem social, área atendida e serviços.

Use `typography.profile` para diferenciar a personalidade visual de cada landing sem alterar o layout. Perfis disponíveis: `clinical` para clínica médica, `family` para pediatria/família, `premium` para estética ou odontologia de alto padrão, `warm` para veterinária ou atendimento acolhedor e `technical` para páginas mais objetivas. O perfil troca famílias tipográficas, pesos e ritmo dos títulos via CSS variables.

Os presets recomendados para cada nicho ficam em `config/presets/niches.php`. O gerador `scripts/create-landing.sh` usa esses presets para sugerir nome, paleta, tipografia, schema SEO e prefixo de protocolo quando o slug é conhecido.

Os conteúdos de nicho versionados são `config/content/pediatria.php`, `config/content/odontologia.php`, `config/content/veterinaria.php`, `config/content/estetica.php` e `config/content/psicologia.php`. Eles herdam a estrutura base de `landing.php` e sobrescrevem textos, SEO, tipografia, serviços, FAQ e mensagens de formulário para cada área.

As imagens principais seguem nomes padronizados: `public/assets/img/hero/{slug}-640.webp`, `{slug}-960.webp`, `{slug}-1896.webp`, `{slug}-mobile-640.webp` e `public/assets/img/social/{slug}-og.jpg`. O corte mobile é vertical para preservar o rosto/atendimento em telas estreitas. O gerador renomeia os placeholders para o slug novo; depois substitua esses arquivos por imagens finais do nicho.

Quando a landing usar uma narrativa editorial em duas partes, configure `journey.intro`, `journey.before`, `journey.transition`, `journey.after` e, se quiser a variante visual, `journey.panels` no arquivo ativo de `config/content/`. A troca entre a versão editorial e a versão com painéis pode ser feita via `APP_JOURNEY_LAYOUT` sem editar o Twig.

Após alterar templates em produção, limpe o cache Twig em `storage/cache/twig` ou rode o script de pós-update.
