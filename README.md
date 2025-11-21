# Prime Match Imo - Sistema SaaS Imobiliário

Plataforma SaaS para gestão, divulgação e matchmaking de imóveis, construída em **Laravel 11**, **Tailwind CSS** e **Docker**. O objetivo é conectar investidores, empresários e corretores prime em um fluxo único, com métricas e planos de assinatura claros.

> Esta é a documentação principal do projeto em português. A descrição detalhada das funcionalidades por perfil está em [`docs/funcionalidades.md`](docs/funcionalidades.md).

## 🚀 Tecnologias
- **PHP 8.3**
- **Laravel 11**
- **MySQL 8**
- **Redis**
- **Nginx**
- **Tailwind CSS** e **Alpine.js**
- **Docker & Docker Compose**

## 📋 Pré-requisitos
- Docker & Docker Compose
- Git
- Make (opcional, mas recomendado)

## 🔧 Instalação e configuração
1. **Clone o repositório**
   ```bash
   git clone https://github.com/leoolivie/prime-match-imo-mvp.git
   cd prime-match-imo-mvp
   ```

2. **Configure as variáveis de ambiente**
   ```bash
   cp .env.example .env
   ```

3. **Construa e suba os containers**
   ```bash
   # Usando Make (recomendado)
   make build
   make up

   # Ou usando Docker Compose
   docker compose build
   docker compose up -d
   ```

4. **Instale as dependências PHP**
   ```bash
   # Via Make
   make install

   # Ou diretamente
   docker compose exec php-fpm composer install
   ```

5. **Gere a chave da aplicação**
   ```bash
   docker compose exec php-fpm php artisan key:generate
   ```

6. **Execute migrações e seeders**
   ```bash
   # Via Make
   make migrate
   make seed
   # Para recriar o banco do zero
   make fresh

   # Ou diretamente
   docker compose exec php-fpm php artisan migrate
   docker compose exec php-fpm php artisan db:seed
   ```

7. **Acesse a aplicação**
   - Web: [http://localhost:8082](http://localhost:8082)
   - Mailpit: [http://localhost:8025](http://localhost:8025) (SMTP de desenvolvimento)

## 👥 Usuários de teste
Após executar os seeders, os seguintes usuários ficam disponíveis:

| Papel          | E-mail                     | Senha    | Descrição                         |
| -------------- | -------------------------- | -------- | --------------------------------- |
| Master (Admin) | master@primematch.com      | password | Administrador do sistema          |
| Corretor Prime | broker@primematch.com      | password | Corretor de imóveis               |
| Empresário     | businessman@primematch.com | password | Proprietário com assinatura ativa |
| Investidor     | investor@primematch.com    | password | Investidor buscando imóveis       |

## 🏗️ Estrutura do projeto
```
prime-match-imo-mvp/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── docker/
│   └── nginx/
├── resources/
│   └── views/
├── routes/
├── docker-compose.yml
├── Makefile
└── ...
```

## 📊 Planos de assinatura (MVP)
| Plano            | Valor/mês | Limite de imóveis | Benefícios principais                              |
| ---------------- | --------- | ----------------- | -------------------------------------------------- |
| Prime Mensal     | R$ 350    | 5                 | Corretor prime, suporte e consultoria              |
| Prime Trimestral | R$ 250    | 15                | Corretor prime, suporte avançado e rede de parceiros |
| Prime Anual      | R$ 200    | Ilimitado         | 1 destaque/mês + todos os benefícios               |

## 🛠️ Comandos úteis (Make)
```bash
make up        # Inicia os containers
make down      # Para os containers
make restart   # Reinicia os containers
make logs      # Logs em tempo real
make bash      # Shell no container PHP
make migrate   # Executa migrations
make seed      # Executa seeders
make fresh     # Recria banco com seeders
make install   # Instala dependências do Composer
make test      # Roda testes
make build     # Constrói imagens Docker
make rebuild   # Reconstrói imagens do zero
```

## 🐳 Serviços Docker
| Serviço | Função                | Porta                             |
| ------- | --------------------- | --------------------------------- |
| nginx   | Servidor web          | 8082:80                           |
| php-fpm | Aplicação Laravel     | (interno)                         |
| mysql   | Banco de dados        | 3306:3306                         |
| redis   | Cache e filas         | 6379:6379                         |
| mailpit | SMTP fake p/ testes   | 8025:8025 (web), 1025:1025 (smtp) |

## 🧪 Testes
```bash
make test
# ou
docker compose exec php-fpm php artisan test
```

## 📝 Arquitetura
- Padrões: **MVC**, **SOLID** e princípios de **Clean Code**
- Preparado para **Repository Pattern** e **Service Layer**
- Fluxo típico: `Controllers → Services → Repositories → Models`, com `Policies`, `Events`, `Listeners` e `Jobs` quando necessário

## 🔒 Segurança e privacidade
- Matrícula de imóvel armazenada como campo privado (visível apenas para proprietário e master)
- Autenticação com hash de senhas e controle de acesso por papéis (RBAC)
- Consentimento de termos de uso obrigatório no cadastro

## 🚀 Roadmap (próximas implementações)
- Upload de imagens de imóveis
- Integração com WhatsApp Business API
- Sistema de pagamentos (Stripe/PagSeguro)
- Notificações por e-mail
- Sistema de reviews
- API RESTful
- App mobile (React Native)
- Testes automatizados completos
- Pipeline de CI/CD

## 📄 Licença
Projeto proprietário e confidencial. Uso restrito ao time Prime Match Imo.

## 👨‍💻 Time
Prime Match Imo Team

---
**Nota:** Este é um MVP (Minimum Viable Product); funcionalidades adicionais serão entregues em próximas iterações.
