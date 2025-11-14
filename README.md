# Prime Match Imo - Sistema SaaS Imobiliário

Sistema completo de gestão e matchmaking imobiliário desenvolvido com Laravel 10, Docker, e Tailwind CSS.
Pode ser executado tanto via Docker quanto em hospedagens compartilhadas com PHP 8.2+ (cPanel).

## 🚀 Tecnologias

-   **Laravel 12** - Framework PHP
-   **PHP 8.3** - Linguagem de programação
-   **MySQL 8** - Banco de dados
-   **Redis** - Cache e filas
-   **Nginx** - Servidor web
-   **Docker & Docker Compose** - Containerização
-   **Tailwind CSS** - Framework CSS
-   **Alpine.js** - JavaScript reativo

## 📋 Pré-requisitos

-   Docker & Docker Compose instalados *(para execução containerizada)*
-   Git
-   Make (opcional, mas recomendado)

## 🔧 Instalação e Configuração

### 1. Clone o repositório

```bash
git clone https://github.com/leoolivie/prime-match-imo-mvp.git
cd prime-match-imo-mvp
```

### 2. Configure o ambiente

```bash
cp .env.example .env
```

### 3. Construa e inicie os containers Docker

```bash
# Usando Make (recomendado)
make build
make up

# Ou usando Docker Compose diretamente
docker compose build
docker compose up -d
```

### 4. Instale as dependências do Laravel

```bash
# Usando Make
make install

# Ou usando Docker Compose
docker compose exec php-fpm composer install
```

### 5. Gere a chave da aplicação

```bash
docker compose exec php-fpm php artisan key:generate
```

### 6. Execute as migrations e seeders

```bash
# Usando Make
make migrate
make seed

# Ou para fazer tudo de uma vez (fresh install)
make fresh

# Ou usando Docker Compose
docker compose exec php-fpm php artisan migrate
docker compose exec php-fpm php artisan db:seed
```

### 7. Acesse a aplicação

Abra seu navegador e acesse: [http://localhost:8082](http://localhost:8082)

## 🌐 Implantação em hospedagem compartilhada (cPanel)

> Utilize esta abordagem quando não for possível executar Docker no provedor.

1. **Requisitos do plano**
   - PHP 8.2 ou superior, com extensões `pdo_mysql`, `mbstring`, `openssl`, `json`, `tokenizer`, `xml` e `fileinfo` habilitadas.
   - MySQL 5.7+ ou MariaDB 10.4+ (crie o banco e usuário no painel cPanel).
   - Acesso SSH habilitado para executar comandos Artisan/Composer.

2. **Preparação local**
   - Clone o projeto e copie o arquivo `.env.example` para `.env`.
   - Ajuste as variáveis do `.env` para o ambiente da hospedagem:
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
   - Caso a hospedagem ofereça Redis, basta alterar as variáveis `CACHE_DRIVER`, `QUEUE_CONNECTION` e `SESSION_DRIVER` para `redis` e preencher `REDIS_HOST`.

3. **Instalação das dependências**
   - No seu ambiente local (ou via SSH, se o plano permitir Composer):
     ```bash
     composer install --no-dev --optimize-autoloader
     npm install
     npm run build
     ```
   - O comando `npm run build` gera os assets em `public/build`. Faça upload dessa pasta para o servidor.

4. **Upload dos arquivos**
   - Envie todos os arquivos do projeto para o servidor, exceto `node_modules/`, `vendor/` (se for instalar via SSH) e diretórios de desenvolvimento (`docker/`).
   - Caso o plano **não** permita rodar `composer install` via SSH, gere a pasta `vendor/` localmente e faça upload.

5. **Configuração no servidor**
   - Defina o diretório raiz do domínio/subdomínio para apontar para a pasta `public/`.
   - Via SSH, execute:
     ```bash
     php artisan key:generate
     php artisan migrate --force
     php artisan storage:link
     php artisan optimize
     ```
   - Ajuste permissões das pastas `storage/` e `bootstrap/cache/` para escrita (por exemplo, `chmod -R 775 storage bootstrap/cache`).

6. **Crons e tarefas agendadas**
   - No cPanel, crie um cron a cada minuto para `php /caminho/para/sua/aplicacao/artisan schedule:run` se o projeto utilizar agendamentos.
   - Para filas, mantendo `QUEUE_CONNECTION=sync` dispensa workers adicionais. Se mudar para `database`, crie um cron adicional para `php artisan queue:work --once`.

7. **Configurações extras**
   - Atualize as variáveis de e-mail (`MAIL_HOST`, `MAIL_PORT`, etc.) com os dados SMTP da HostGator.
   - Ative HTTPS (Let's Encrypt) e verifique os logs em `storage/logs/` após o deploy.

## 👥 Usuários de Teste

Após executar os seeders, você terá acesso aos seguintes usuários de teste:

| Papel          | E-mail                     | Senha    | Descrição                         |
| -------------- | -------------------------- | -------- | --------------------------------- |
| Master (Admin) | master@primematch.com      | password | Administrador do sistema          |
| Corretor Prime | broker@primematch.com      | password | Corretor de imóveis               |
| Empresário     | businessman@primematch.com | password | Proprietário com assinatura ativa |
| Investidor     | investor@primematch.com    | password | Investidor buscando imóveis       |

## 🏗️ Estrutura do Projeto

```
prime-match-imo-mvp/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   ├── Investor/
│   │   ├── Businessman/
│   │   ├── Broker/
│   │   └── Master/
│   └── Models/
│       ├── User.php
│       ├── Property.php
│       ├── Subscription.php
│       ├── SubscriptionPlan.php
│       ├── Lead.php
│       ├── PrimeSearch.php
│       └── Partner.php
├── database/
│   ├── migrations/
│   └── seeders/
├── docker/
│   └── nginx/
├── resources/
│   └── views/
├── docker-compose.yml
├── Dockerfile
└── Makefile
```

## 🎯 Funcionalidades

### Landing Page

-   Apresentação do sistema
-   Informações sobre planos e recursos
-   Formulário de cadastro

### Para Investidores

-   **Busca Prime**: Busca avançada de imóveis com filtros
-   **Alertas**: Criação de alertas personalizados
-   **Leads**: Registro de interesse em imóveis
-   **Dashboard**: Visualização de buscas e leads

### Para Empresários

-   **Gestão de Imóveis**: CRUD completo de imóveis
-   **Planos de Assinatura**:
    -   **Prime Mensal** (R$ 350/mês): Até 5 imóveis
    -   **Prime Trimestral** (R$ 250/mês): Até 15 imóveis
    -   **Prime Anual** (R$ 200/mês): Imóveis ilimitados + 1 destaque/mês
-   **Leads**: Visualização de interessados
-   **Métricas**: Dashboard com estatísticas

### Para Corretores Prime

-   **Gestão de Leads**: Atribuição e acompanhamento
-   **WhatsApp**: Contato direto com investidores
-   **CRM**: Sistema de acompanhamento de leads
-   **Métricas**: Performance e conversões

### Para Master (Admin)

-   **CRUD de Usuários**: Gestão completa de usuários
-   **Gestão de Imóveis**: Visualização e moderação
-   **Parceiros**: Cadastro de parceiros do sistema
-   **Assinaturas**: Gestão de planos e pagamentos
-   **Relatórios**: Dashboards com métricas do sistema

## 📊 Planos de Assinatura

| Plano            | Valor/mês | Limite de Imóveis | Benefícios                                  |
| ---------------- | --------- | ----------------- | ------------------------------------------- |
| Prime Mensal     | R$ 350    | 5                 | Corretor prime, suporte, consultoria        |
| Prime Trimestral | R$ 250    | 15                | Corretor prime, suporte avançado, parceiros |
| Prime Anual      | R$ 200    | Ilimitado         | 1 destaque/mês + todos os benefícios        |

## 🔐 Segurança e Privacidade

-   **Matrícula de Imóvel**: Campo privado, visível apenas para proprietário e master
-   **Autenticação**: Sistema seguro com hash de senhas
-   **Autorização**: Controle de acesso baseado em papéis (RBAC)
-   **Termos de Uso**: Consentimento obrigatório no cadastro

## 🛠️ Comandos Make Disponíveis

```bash
make up              # Inicia os containers
make down            # Para os containers
make restart         # Reinicia os containers
make logs            # Visualiza logs em tempo real
make bash            # Acessa o container PHP
make migrate         # Executa migrations
make seed            # Executa seeders
make fresh           # Recria banco de dados com seeders
make install         # Instala dependências do Composer
make test            # Executa testes
make build           # Constrói as imagens Docker
make rebuild         # Reconstrói as imagens do zero
```

## 🐳 Serviços Docker

| Serviço | Função                | Porta                             |
| ------- | --------------------- | --------------------------------- |
| nginx   | Servidor web          | 8082:80                           |
| php-fpm | Aplicação Laravel     | (interno)                         |
| mysql   | Banco de dados        | 3306:3306                         |
| redis   | Cache e filas         | 6379:6379                         |
| mailpit | SMTP fake para testes | 8025:8025 (web), 1025:1025 (smtp) |

### Mailpit

Para visualizar os e-mails enviados pela aplicação em ambiente de desenvolvimento, acesse:
[http://localhost:8025](http://localhost:8025)

## 🧪 Testes

Para executar os testes:

```bash
make test

# Ou
docker compose exec php-fpm php artisan test
```

## 📝 Arquitetura

O sistema segue os princípios:

-   **MVC** (Model-View-Controller)
-   **SOLID**
-   **Clean Code**
-   **Repository Pattern** (preparado para implementação)
-   **Service Layer** (preparado para implementação)

### Camadas da Aplicação

```
Controllers → Services → Repositories → Models
     ↓
  Policies
     ↓
   Events → Listeners → Jobs
```

## 🔄 Fluxo de Trabalho

### Busca Prime (Investidor)

1. Investidor preenche formulário de busca
2. Sistema filtra imóveis disponíveis
3. Opção de criar alerta para novas correspondências
4. Investidor registra interesse (cria lead)
5. Lead atribuído a corretor prime
6. Corretor entra em contato via WhatsApp

### Cadastro de Imóvel (Empresário)

1. Empresário verifica plano ativo e limite
2. Preenche dados do imóvel
3. Matrícula mantida privada
4. Imóvel aparece nas buscas
5. Leads são gerados automaticamente

## 🚀 Próximas Implementações

-   [ ] Upload de imagens de imóveis
-   [ ] Integração com WhatsApp Business API
-   [ ] Sistema de pagamentos (Stripe/PagSeguro)
-   [ ] Notificações por e-mail
-   [ ] Sistema de reviews
-   [ ] API RESTful
-   [ ] App mobile (React Native)
-   [ ] Testes automatizados completos
-   [ ] CI/CD pipeline

## 📄 Licença

Este projeto é proprietário e confidencial.

## 👨‍💻 Desenvolvido por

Prime Match Imo Team

---

**Nota**: Este é um MVP (Minimum Viable Product). Funcionalidades adicionais serão implementadas nas próximas iterações.
