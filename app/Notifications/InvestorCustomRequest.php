<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvestorCustomRequest extends Notification
{
    use Queueable;

    public function __construct(protected array $data)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $city = $this->data['city'] ?: 'Nao informada';

        return (new MailMessage)
            ->subject('Novo briefing personalizado do investidor')
            ->greeting('Ola, Master Prime!')
            ->line('Um investidor enviou um briefing personalizado a partir da vitrine publica.')
            ->line('Nome: ' . $this->data['name'])
            ->line('Telefone: ' . $this->data['phone'])
            ->line('Cidade: ' . $city)
            ->line('Descricao do pedido: ' . $this->data['description'])
            ->line('Origem: /investidor - formulario "Nao encontrei o imovel"')
            ->line('A equipe concierge deve retornar o contato imediatamente.');
    }
}
