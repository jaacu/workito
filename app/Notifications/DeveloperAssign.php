<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Proyect;

class DeveloperAssign extends Notification implements ShouldQueue
{
    use Queueable;

    public $proyecto;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( Proyect $proyecto)
    {
        $this->proyecto = $proyecto;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
    return ['mail','database'/*,'broadcast'*/];
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
        ->subject('Te han asignado a un nuevo proyecto.')
        ->greeting('Hola, '.$notifiable->name)
        ->line('Has sido asignado al proyecto '. $this->proyecto->nombre . '.')
        ->action('Ver proyecto.', url('/proyecto/show/'. $this->proyecto->id))
        ->salutation('Leanga Software');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $mensaje = 'Has sido asignado al proyecto "'.$this->proyecto->nombre.'"!';
        $ruta = '/proyecto/show/'. $this->proyecto->id;
        return [
            'mensaje' => $mensaje,
            'ruta' =>$ruta,
        ];
    }

    public function toBroadcast($notifiable)
    {
        // $mensaje = 'Has sido asignado al proyecto "'.$this->proyecto->nombre.'"!';
        // $ruta = '/proyecto/show/'. $this->proyecto->id;
        return new BroadcastMessage([
            'data' => $this->toArray($notifiable),
        ]);
    }

}
