<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailResetPassword extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Notificación de restablecimiento de contraseña')
                    ->greeting('¡Hola!')
                    ->line('Ha recibido este mensaje porque solicitó un restablecimiento de contraseña para su cuenta.')
                    ->action('Resetear contraseña', route('password.reset', ['token' => $this->token]))
                    ->line('Este enlace de restablecimiento de contraseña expira en 60 minutos.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])
                    ->line('Si no solicitó un restablecimiento de contraseña, omita este mensaje de correo electrónico.')
                    ->salutation('Saludos, '.config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
