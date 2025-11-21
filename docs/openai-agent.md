# Agente IA para cruzar investidores e imóveis

## O que foi adicionado
- Endpoint interno para o master visualizar recomendações em `/master/ai/recommendations`.
- Serviço `App\Services\OpenAiPropertyMatchService` que consulta MySQL (PrimeSearch + imóveis ativos) e envia contexto para a OpenAI.
- Configuração em `config/services.php` para `OPENAI_API_KEY`, `OPENAI_MODEL` e `OPENAI_API_BASE`.
- Validação de chave: se houver dados e a variável `OPENAI_API_KEY` não estiver definida, o painel exibe o motivo do erro.
- Normalização de features armazenadas como JSON string nos imóveis e buscas para evitar payloads vazios.

## Como gerar e configurar a chave da OpenAI
1. Crie ou recupere uma chave em [platform.openai.com/api-keys](https://platform.openai.com/api-keys).
2. No arquivo `.env`, adicione:
   ```env
   OPENAI_API_KEY="sua_chave_aqui"
   OPENAI_MODEL=gpt-4o-mini # opcional
   OPENAI_API_BASE=https://api.openai.com/v1 # opcional
   ```
3. Em Docker ou produção, defina as variáveis de ambiente no serviço (compose, painel da cloud ou provider).
4. Reinicie PHP-FPM/containers para recarregar as variáveis.

## Como usar
- Acesse `/master/ai/recommendations` autenticado como master.
- Ajuste o "Ticket mínimo" para filtrar investidores (PrimeSearch) e imóveis de luxo (preço >= mínimo) do MySQL.
- O painel mostra o JSON retornado pela OpenAI, resumo e payload bruto para depuração, e só chama a API se existir pelo menos um investidor e um imóvel.

## Estrutura da resposta esperada da IA
```json
{
  "summary": "resumo breve",
  "matches": [
    {"investor_id": 1, "property_id": 10, "fit_reason": "por que combina"}
  ]
}
```

Se não houver chave ou o request falhar, o painel exibe o motivo para correção rápida.
