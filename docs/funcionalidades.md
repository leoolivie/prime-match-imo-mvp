# Funcionalidades do Prime Match Imo

Este documento descreve, em detalhes, os recursos disponíveis no MVP do Prime Match Imo, organizados por perfil de usuário e camada do sistema.

## Sumário
- [Landing Page e aquisição](#landing-page-e-aquisição)
- [Investidor](#investidor)
- [Empresário](#empresário)
- [Corretor Prime](#corretor-prime)
- [Master (Admin)](#master-admin)
- [Funcionalidades transversais](#funcionalidades-transversais)
- [Fluxos principais](#fluxos-principais)

## Landing Page e aquisição
- Apresentação comercial do sistema e diferenciais do serviço.
- Exibição de planos e limites de cada assinatura.
- Formulário de cadastro inicial com aceite de termos de uso.

## Investidor
- **Busca Prime:** busca avançada de imóveis com filtros por região, tipologia e faixas de investimento.
- **Alertas inteligentes:** criação e edição de alertas de novas correspondências de imóveis.
- **Registro de interesse (leads):** envio de intenção de compra ou visita, gerando lead para corretores prime.
- **Dashboard pessoal:** listagem de buscas criadas, alertas ativos e histórico de leads.
- **Atendimento direto:** opção de contato via WhatsApp para leads atribuídos.

## Empresário
- **Gestão de imóveis:** CRUD completo de imóveis com campos públicos e privados (incluindo matrícula protegida).
- **Planos de assinatura:**
  - **Prime Mensal (R$ 350/mês):** até 5 imóveis.
  - **Prime Trimestral (R$ 250/mês):** até 15 imóveis.
  - **Prime Anual (R$ 200/mês):** imóveis ilimitados e 1 destaque/mês.
- **Controle de limites:** bloqueio amigável quando o limite do plano é atingido, com sugestão de upgrade.
- **Leads recebidos:** visualização de interessados nos seus imóveis e status de atendimento.
- **Métricas operacionais:** dashboard com indicadores de imóveis publicados, leads e conversões.

## Corretor Prime
- **Central de leads:** recebimento, atribuição e acompanhamento de leads provenientes de investidores.
- **CRM simplificado:** atualização de status, comentários e próximos passos para cada lead.
- **Contato imediato:** integração rápida com WhatsApp para abordar investidores.
- **Desempenho individual:** métricas de conversão, tempo de resposta e volume atendido.

## Master (Admin)
- **Gestão de usuários:** CRUD completo de investidores, empresários, corretores e masters.
- **Gestão de imóveis:** supervisão e moderação de anúncios.
- **Parceiros:** cadastro e manutenção de parceiros estratégicos do sistema.
- **Planos e assinaturas:** criação, edição e gestão de planos, limites e pagamentos.
- **Relatórios executivos:** dashboards com KPIs de uso, receita e engajamento por perfil.

## Funcionalidades transversais
- **Segurança:** autenticação com hashing de senhas e RBAC por papéis (investidor, empresário, corretor, master).
- **Privacidade de dados:** matrícula do imóvel é campo privado, acessível apenas ao proprietário e master.
- **Notificações:** suporte a Mailpit para testes de e-mail em ambiente local.
- **Performance:** Redis para cache e filas de processamento.
- **Deploy containerizado:** ambiente replicável via Docker e Docker Compose.

## Fluxos principais
### Busca Prime (Investidor)
1. Investidor preenche formulário de busca com filtros e intenção de investimento.
2. Sistema retorna imóveis compatíveis e oferece criação de alerta para novas correspondências.
3. Investidor registra interesse em um imóvel (gera lead).
4. Lead é atribuído a um corretor prime, que faz o contato inicial via WhatsApp.
5. Status do lead é acompanhado pelo investidor e pelo corretor.

### Cadastro de imóvel (Empresário)
1. Empresário verifica se há plano ativo e se o limite de imóveis permite novo cadastro.
2. Preenche dados do imóvel; a matrícula permanece privada.
3. Imóvel passa a aparecer nas buscas dos investidores e pode ser destacado conforme o plano.
4. Leads gerados são enviados ao empresário e ao corretor responsável.
5. Métricas de desempenho são atualizadas no dashboard do empresário.
