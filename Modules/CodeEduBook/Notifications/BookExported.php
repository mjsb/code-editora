<?php

namespace CodeEduBook\Notifications;

use CodeEduBook\Models\Livro;
use CodeEduUser\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookExported extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    /**
     * @var Livro
     */
    private $livro;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Livro $livro)
    {
        //
        $this->user = $user;
        $this->livro = $livro;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Seu livro já foi exportado!')
                    ->greeting("Olá {$this->user->name}!")
                    ->line("O livro {$this->livro->title} já foi exportado.")
                    ->action('Download', route('livros.download', ['id' => $this->livro->id]))
                    ->line('Obrigado por usar nosso aplicativo!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
