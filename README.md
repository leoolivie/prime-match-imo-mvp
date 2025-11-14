# Prime Match Imo - Sistema SaaS Imobiliário

Sistema completo de gestão e matchmaking imobiliário desenvolvido com Laravel 11, PHP 8.3, Vite e Tailwind CSS.
Projetado para rodar diretamente via PHP local (php artisan serve) ou em hospedagens compartilhadas com PHP 8.3+.

## Tecnologias

-   **Laravel 11** - Framework PHP
-   **PHP 8.3** - Linguagem e runtime
-   **MySQL 8** - Banco de dados relacional
-   **Redis** - Cache e filas (opcional)
-   **Nginx** - Servidor web (produção)
-   **Node.js + Vite** - Pipeline de frontend
-   **Tailwind CSS** - Framework CSS
-   **Alpine.js** - Comportamento reativo leve

## Pré-requisitos

-   PHP 8.3 com extensões pdo_mysql, mbstring, openssl, json, 	okenizer, xml, ileinfo
-   Composer
-   Node.js 20+ e npm
-   MySQL 8 / MariaDB 10.4+
-   Redis (opcional)
-   Git
-   Make (opcional)

## Instalação e Configuração Local

### 1. Clone o repositório

`ash
git clone https://github.com/leoolivie/prime-match-imo-mvp.git
cd prime-match-imo-mvp
`

### 2. Configure o ambiente

`ash
cp .env.example .env
`

Ajuste .env para apontar para o seu banco local e SMTP:

`ini
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=primematch
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file

MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="noreply@primematch.com"
MAIL_FROM_NAME="${APP_NAME}"
`

> Para capturar e-mails localmente, instale o Mailpit (https://mailpit.dev) e mantenha as portas 8025/1025.

### 3. Instale as dependências

`ash
make install
`

### 4. Gere a chave da aplicação

`ash
make key
`

### 5. Execute migrations e seeders

`ash
make migrate
make seed
`

Para recriar o banco e popular novamente, execute make fresh.

### 6. Compile os assets

`ash
make dev    # ativa o watcher Vite
make build  # build otimizado para produção
`

### 7. Execute o servidor

`ash
make serve
`

Após isso, abra http://127.0.0.1:8000 no navegador. Use make help para ver os atalhos disponíveis.
## ðŸŒ ImplantaÃ§Ã£o em hospedagem compartilhada (cPanel)

> Este passo a passo serve para hospedagens compartilhadas sem acesso root; ajuste conforme as ferramentas fornecidas.

1. **Requisitos do plano**
   - PHP 8.2 ou superior, com extensÃµes `pdo_mysql`, `mbstring`, `openssl`, `json`, `tokenizer`, `xml` e `fileinfo` habilitadas.
   - MySQL 5.7+ ou MariaDB 10.4+ (crie o banco e usuÃ¡rio no painel cPanel).
   - Acesso SSH habilitado para executar comandos Artisan/Composer.

2. **PreparaÃ§Ã£o local**
   - Clone o projeto e copie o arquivo `.env.example` para `.env`.
   - Ajuste as variÃ¡veis do `.env` para o ambiente da hospedagem:
     ```ini
     APP_ENV=production
     APP_DEBUG=false
     APP_URL=https://seu-dominio.com

     DB_HOST=localhost
     DB_PORT=3306
     DB_DATABASE=nome_do_banco
     DB_USERNAME=usuario_do_banco
     DB_PASSWORD=senha_do_banco

     CACHE_DRIVER=file
     QUEUE_CONNECTION=sync
     SESSION_DRIVER=file
     FILESYSTEM_DISK=public
     ```
   - Caso a hospedagem ofereÃ§a Redis, basta alterar as variÃ¡veis `CACHE_DRIVER`, `QUEUE_CONNECTION` e `SESSION_DRIVER` para `redis` e preencher `REDIS_HOST`.

3. **InstalaÃ§Ã£o das dependÃªncias**
   - No seu ambiente local (ou via SSH, se o plano permitir Composer):
     ```bash
     composer install --no-dev --optimize-autoloader
     npm install
     npm run build
     ```
   - O comando `npm run build` gera os assets em `public/build`. FaÃ§a upload dessa pasta para o servidor.

4. **Upload dos arquivos**
   - Envie todos os arquivos do projeto para o servidor, exceto `node_modules/` e `vendor/` (se for instalar via SSH); mantenha arquivos de build locais fora do upload.
   - Caso o plano **nÃ£o** permita rodar `composer install` via SSH, gere a pasta `vendor/` localmente e faÃ§a upload.

5. **ConfiguraÃ§Ã£o no servidor**
   - Defina o diretÃ³rio raiz do domÃ­nio/subdomÃ­nio para apontar para a pasta `public/`.
   - Via SSH, execute:
     ```bash
     php artisan key:generate
     php artisan migrate --force
     php artisan storage:link
     php artisan optimize
     ```
   - Ajuste permissÃµes das pastas `storage/` e `bootstrap/cache/` para escrita (por exemplo, `chmod -R 775 storage bootstrap/cache`).

6. **Crons e tarefas agendadas**
   - No cPanel, crie um cron a cada minuto para `php /caminho/para/sua/aplicacao/artisan schedule:run` se o projeto utilizar agendamentos.
   - Para filas, mantendo `QUEUE_CONNECTION=sync` dispensa workers adicionais. Se mudar para `database`, crie um cron adicional para `php artisan queue:work --once`.

7. **ConfiguraÃ§Ãµes extras**
   - Atualize as variÃ¡veis de e-mail (`MAIL_HOST`, `MAIL_PORT`, etc.) com os dados SMTP da HostGator.
   - Ative HTTPS (Let's Encrypt) e verifique os logs em `storage/logs/` apÃ³s o deploy.

## ðŸ‘¥ UsuÃ¡rios de Teste

ApÃ³s executar os seeders, vocÃª terÃ¡ acesso aos seguintes usuÃ¡rios de teste:

| Papel          | E-mail                     | Senha    | DescriÃ§Ã£o                         |
| -------------- | -------------------------- | -------- | --------------------------------- |
| Master (Admin) | master@primematch.com      | password | Administrador do sistema          |
| Corretor Prime | broker@primematch.com      | password | Corretor de imÃ³veis               |
| EmpresÃ¡rio     | businessman@primematch.com | password | ProprietÃ¡rio com assinatura ativa |
| Investidor     | investor@primematch.com    | password | Investidor buscando imÃ³veis       |

## ðŸ—ï¸ Estrutura do Projeto

```
prime-match-imo-mvp/
â”œâ”€â”€ app/
â”‚   â”œâ”€â”€ Http/Controllers/
â”‚   â”‚   â”œâ”€â”€ AuthController.php
â”‚   â”‚   â”œâ”€â”€ Investor/
â”‚   â”‚   â”œâ”€â”€ Businessman/
â”‚   â”‚   â”œâ”€â”€ Broker/
â”‚   â”‚   â””â”€â”€ Master/
â”‚   â””â”€â”€ Models/
â”‚       â”œâ”€â”€ User.php
â”‚       â”œâ”€â”€ Property.php
â”‚       â”œâ”€â”€ Subscription.php
â”‚       â”œâ”€â”€ SubscriptionPlan.php
â”‚       â”œâ”€â”€ Lead.php
â”‚       â”œâ”€â”€ PrimeSearch.php
â”‚       â””â”€â”€ Partner.php
â”œâ”€â”€ database/
â”‚   â”œâ”€â”€ migrations/
â”‚   â””â”€â”€ seeders/
â””â”€â”€ Makefile
```

## ðŸŽ¯ Funcionalidades

### Landing Page

-   ApresentaÃ§Ã£o do sistema
-   InformaÃ§Ãµes sobre planos e recursos
-   FormulÃ¡rio de cadastro

### Para Investidores

-   **Busca Prime**: Busca avanÃ§ada de imÃ³veis com filtros
-   **Alertas**: CriaÃ§Ã£o de alertas personalizados
-   **Leads**: Registro de interesse em imÃ³veis
-   **Dashboard**: VisualizaÃ§Ã£o de buscas e leads

### Para EmpresÃ¡rios

-   **GestÃ£o de ImÃ³veis**: CRUD completo de imÃ³veis
-   **Planos de Assinatura**:
    -   **Prime Mensal** (R$ 350/mÃªs): AtÃ© 5 imÃ³veis
    -   **Prime Trimestral** (R$ 250/mÃªs): AtÃ© 15 imÃ³veis
    -   **Prime Anual** (R$ 200/mÃªs): ImÃ³veis ilimitados + 1 destaque/mÃªs
-   **Leads**: VisualizaÃ§Ã£o de interessados
-   **MÃ©tricas**: Dashboard com estatÃ­sticas

### Para Corretores Prime

-   **GestÃ£o de Leads**: AtribuiÃ§Ã£o e acompanhamento
-   **WhatsApp**: Contato direto com investidores
-   **CRM**: Sistema de acompanhamento de leads
-   **MÃ©tricas**: Performance e conversÃµes

### Para Master (Admin)

-   **CRUD de UsuÃ¡rios**: GestÃ£o completa de usuÃ¡rios
-   **GestÃ£o de ImÃ³veis**: VisualizaÃ§Ã£o e moderaÃ§Ã£o
-   **Parceiros**: Cadastro de parceiros do sistema
-   **Assinaturas**: GestÃ£o de planos e pagamentos
-   **RelatÃ³rios**: Dashboards com mÃ©tricas do sistema

## ðŸ“Š Planos de Assinatura

| Plano            | Valor/mÃªs | Limite de ImÃ³veis | BenefÃ­cios                                  |
| ---------------- | --------- | ----------------- | ------------------------------------------- |
| Prime Mensal     | R$ 350    | 5                 | Corretor prime, suporte, consultoria        |
| Prime Trimestral | R$ 250    | 15                | Corretor prime, suporte avanÃ§ado, parceiros |
| Prime Anual      | R$ 200    | Ilimitado         | 1 destaque/mÃªs + todos os benefÃ­cios        |

## ðŸ” SeguranÃ§a e Privacidade

-   **MatrÃ­cula de ImÃ³vel**: Campo privado, visÃ­vel apenas para proprietÃ¡rio e master
-   **AutenticaÃ§Ã£o**: Sistema seguro com hash de senhas
-   **AutorizaÃ§Ã£o**: Controle de acesso baseado em papÃ©is (RBAC)
-   **Termos de Uso**: Consentimento obrigatÃ³rio no cadastro

## Comandos Make Disponíveis

```bash
make install        # Composer + npm install
make composer-install # Composer install only
make migrate        # Executa migrations
make seed           # Executa seeders
make fresh          # migrate:fresh --seed
make test           # Phpunit / Pest
make queue          # queue:work local
make dev            # npm run dev (watcher)
make build          # npm run build (production assets)
make serve          # php artisan serve --host=127.0.0.1 --port=8000
make key            # php artisan key:generate
make help           # Lista os comandos disponíveis
```

## Infraestrutura Local Recomendada

| Serviço | Função | Porta local |
| ------- | ------ | ----------- |
| MySQL 8 | Banco de dados principal | 3306 |
| Redis (opcional) | Cache e filas | 6379 |
| Mailpit / Mailhog (opcional) | SMTP fake para testes | 8025 (web) / 1025 (SMTP) |

Instale esses serviços localmente ou utilize equivalentes gerenciados; ajuste `.env` para apontar para os hosts e portas corretas.


## ðŸ§ª Testes

Para executar os testes:

```bash
make test

# Ou
php artisan test
```

## ðŸ“ Arquitetura

O sistema segue os princÃ­pios:

-   **MVC** (Model-View-Controller)
-   **SOLID**
-   **Clean Code**
-   **Repository Pattern** (preparado para implementaÃ§Ã£o)
-   **Service Layer** (preparado para implementaÃ§Ã£o)

### Camadas da AplicaÃ§Ã£o

```
Controllers â†’ Services â†’ Repositories â†’ Models
     â†“
  Policies
     â†“
   Events â†’ Listeners â†’ Jobs
```

## ðŸ”„ Fluxo de Trabalho

### Busca Prime (Investidor)

1. Investidor preenche formulÃ¡rio de busca
2. Sistema filtra imÃ³veis disponÃ­veis
3. OpÃ§Ã£o de criar alerta para novas correspondÃªncias
4. Investidor registra interesse (cria lead)
5. Lead atribuÃ­do a corretor prime
6. Corretor entra em contato via WhatsApp

### Cadastro de ImÃ³vel (EmpresÃ¡rio)

1. EmpresÃ¡rio verifica plano ativo e limite
2. Preenche dados do imÃ³vel
3. MatrÃ­cula mantida privada
4. ImÃ³vel aparece nas buscas
5. Leads sÃ£o gerados automaticamente

## ðŸš€ PrÃ³ximas ImplementaÃ§Ãµes

-   [ ] Upload de imagens de imÃ³veis
-   [ ] IntegraÃ§Ã£o com WhatsApp Business API
-   [ ] Sistema de pagamentos (Stripe/PagSeguro)
-   [ ] NotificaÃ§Ãµes por e-mail
-   [ ] Sistema de reviews
-   [ ] API RESTful
-   [ ] App mobile (React Native)
-   [ ] Testes automatizados completos
-   [ ] CI/CD pipeline

## ðŸ“„ LicenÃ§a

Este projeto Ã© proprietÃ¡rio e confidencial.

## ðŸ‘¨â€ðŸ’» Desenvolvido por

Prime Match Imo Team

---

**Nota**: Este Ã© um MVP (Minimum Viable Product). Funcionalidades adicionais serÃ£o implementadas nas prÃ³ximas iteraÃ§Ãµes.





