# Prime Match WordPress Edition

A versão WordPress do Prime Match Imo foi pensada para funcionar em hospedagens compartilhadas como a HostGator mantendo o mesmo posicionamento de marca, experiência de front-end e rotinas de back-office.

## Estrutura

```
prime-match-wordpress/
├── wp-content/
│   ├── plugins/
│   │   └── prime-match-core/      # Plugin responsável pelo matchmaking, CPTs e API
│   └── themes/
│       └── prime-match-theme/     # Tema headless-friendly inspirado na landing do MVP Laravel
└── README.md
```

## Instalação rápida

1. Suba um WordPress "vazio" (6.5+) no seu painel HostGator.
2. Faça upload da pasta `prime-match-theme` para `wp-content/themes` e da pasta `prime-match-core` para `wp-content/plugins`.
3. No painel wp-admin ative primeiro o plugin Prime Match Core e depois o tema Prime Match.
4. Vá em **Aparência → Personalizar → Identidade do site** e ajuste logo, cores e menus conforme necessidade.
5. Crie uma página chamada "Prime Match" e defina-a como página inicial em **Configurações → Leitura** para usar o `front-page.php`.

## Recursos principais

- **Tema custom** com hero cinematográfico, cards de propriedades e sessões de depoimentos replicando a identidade do MVP.
- **Plugin core** com CPTs (`property_listing`, `investor_profile`, `broker_lead` e `match_record`), metadados, REST API e shortcodes.
- **Formulários AJAX** reutilizáveis via shortcodes: `[prime_match_investor_form]`, `[prime_match_property_form]` e `[prime_match_dashboard]`.
- **Matchmaking** baseado em orçamento, cidade e tipologia. Sempre que um investidor é cadastrado a API retorna propriedades compatíveis e armazena pares em `match_record`.
- **Compatível com cache**: todas as requisições front-end usam `wp_rest` e `wp_nonce` para segurança.

## Build do front-end

O tema traz os estilos pré-compilados em `assets/css/theme.css`. Caso queira reprocessar Tailwind/Vite, instale Node 20+ e rode:

```bash
cd wp-content/themes/prime-match-theme
npm install
npm run build
```

> O `package.json` já referencia Tailwind e autoprefixer. Para ajustes rápidos basta editar `assets/css/theme.css` manualmente.

## Deploy recomendado HostGator

1. Comprimir `prime-match-wordpress/wp-content` em um `.zip` e enviar via Gerenciador de Arquivos.
2. Ajustar permissões para 755 em diretórios e 644 em arquivos.
3. Criar um banco dedicado e apontar o `wp-config.php` normalmente.
4. Caso use Cloudflare/Proxy lembre-se de liberar as rotas `/wp-json/prime-match/v1/*`.

## Testes

- Utilize o menu **Prime Match → Simulador** (plugin) para cadastrar propriedades fictícias e investidores.
- Execute o shortcode `[prime_match_dashboard]` em uma página privada para ver o painel com estatísticas em tempo real.

Ficou com dúvida? Consulte os comentários nos arquivos `functions.php` do tema e `prime-match-core.php` do plugin – ambos documentam as integrações com o REST e os pontos de extensão.
