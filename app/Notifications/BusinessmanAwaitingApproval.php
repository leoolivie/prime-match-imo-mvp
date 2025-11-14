<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BusinessmanAwaitingApproval extends Notification
{
    use Queueable;

    public function __construct(protected User $businessman)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Novo empresário aguardando validação do CRECI')
            ->greeting('Olá, Master Prime!')
            ->line('Um empresário concluiu o cadastro e aguarda liberação para cadastrar imóveis.')
            ->line('Nome: ' . $this->businessman->name)
            ->line('E-mail: ' . $this->businessman->email)
            ->line('CRECI: ' . $this->businessman->creci)
            ->line('CPF/CNPJ: ' . $this->businessman->cpf_cnpj)
            ->line('UF: ' . $this->businessman->businessman_state)
            ->action('Revisar cadastro', route('master.users.edit', $this->businessman))
            ->line('Libere o cadastro apenas após validar que o CRECI está ativo.');
    }
}
