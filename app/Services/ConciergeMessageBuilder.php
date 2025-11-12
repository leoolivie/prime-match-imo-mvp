<?php

namespace App\Services;

use Illuminate\Support\Arr;

class ConciergeMessageBuilder
{
    public function build(string $context, array $payload = []): string
    {
        $tags = $this->formatTags($payload['tags'] ?? []);

        return match ($context) {
            'investidor_detalhe' => $this->investorDetailMessage($payload, $tags),
            'busca_prime' => $this->primeSearchMessage($payload, $tags),
            'empresario_duvida' => $this->businessmanSupportMessage($payload),
            'broker_support' => $this->brokerSupportMessage($payload),
            default => $this->investorCardMessage($payload, $tags),
        };
    }

    protected function investorCardMessage(array $payload, string $tags): string
    {
        $city = $payload['city'] ?? 'cidade desejada';
        $type = $payload['type'] ?? 'imóvel de alto padrão';
        $range = $this->formatRange($payload['budget_min'] ?? null, $payload['budget_max'] ?? null, $payload['price'] ?? null);
        $link = $payload['url'] ?? ($payload['property_url'] ?? '');

        return trim(
            sprintf(
                'Olá, sou Investidor. Perfil: %s/%s, faixa %s.%s%s',
                $city,
                $type,
                $range,
                $tags ? " Preferências: {$tags}." : '',
                $link ? " Link do imóvel: {$link}." : ''
            )
        );
    }

    protected function investorDetailMessage(array $payload, string $tags): string
    {
        $title = $payload['title'] ?? 'imóvel prime';
        $city = $payload['city'] ?? 'Cidade';
        $state = $payload['state'] ?? 'UF';
        $url = $payload['url'] ?? 'https://primematchimo.com.br';
        $range = $this->formatRange($payload['budget_min'] ?? null, $payload['budget_max'] ?? null, $payload['price'] ?? null);

        return trim(
            sprintf(
                'Olá, sou Investidor. Quero falar sobre o imóvel: %s - %s/%s (%s). Budget: %s.%s',
                $title,
                $city,
                $state,
                $url,
                $range,
                $tags ? " Preferências: {$tags}." : ''
            )
        );
    }

    protected function primeSearchMessage(array $payload, string $tags): string
    {
        $city = $payload['city'] ?? 'qualquer cidade';
        $type = $payload['type'] ?? 'imóvel de luxo';
        $range = $this->formatRange($payload['budget_min'] ?? null, $payload['budget_max'] ?? null, null);
        $urgency = $payload['urgency'] ?? null;

        $message = sprintf(
            'Olá, sou Investidor. Procuro %s em %s na faixa %s.',
            $type,
            $city,
            $range
        );

        if ($tags) {
            $message .= " Preferências: {$tags}.";
        }

        if ($urgency) {
            $message .= " Urgência: {$urgency}.";
        }

        return $message . ' Pode me orientar?';
    }

    protected function businessmanSupportMessage(array $payload): string
    {
        $title = $payload['title'] ?? 'meu imóvel';
        $city = $payload['city'] ?? 'minha cidade';

        return sprintf(
            'Olá, sou Empresário. Preciso de ajuda para cadastrar meu imóvel %s/%s. Pode orientar?',
            $title,
            $city
        );
    }

    protected function brokerSupportMessage(array $payload): string
    {
        $title = $payload['title'] ?? 'minha carteira';
        $city = $payload['city'] ?? 'minha região';
        $state = $payload['state'] ?? null;
        $location = $state ? $city . '/' . $state : $city;

        return sprintf(
            'Olá, sou Corretor Prime. Gostaria de alinhar atendimento para o imóvel %s em %s. Pode me orientar?',
            $title,
            $location
        );
    }

    protected function formatTags(array|string|null $tags): string
    {
        if (is_string($tags)) {
            return $tags;
        }

        if (empty($tags)) {
            return '';
        }

        $tags = array_filter(array_map('trim', Arr::wrap($tags)));

        return implode(', ', $tags);
    }

    protected function formatRange($min, $max, $singleValue): string
    {
        if (!is_null($min) && !is_null($max)) {
            return sprintf('%s - %s', $this->formatCurrency($min), $this->formatCurrency($max));
        }

        if (!is_null($min) && is_null($max)) {
            return sprintf('a partir de %s', $this->formatCurrency($min));
        }

        if (is_null($min) && !is_null($max)) {
            return sprintf('até %s', $this->formatCurrency($max));
        }

        if (!is_null($singleValue)) {
            return $this->formatCurrency($singleValue);
        }

        return 'custom';
    }

    protected function formatCurrency($value): string
    {
        if (is_null($value)) {
            return 'sob consulta';
        }

        return 'R$ ' . number_format((float) $value, 0, ',', '.');
    }
}
