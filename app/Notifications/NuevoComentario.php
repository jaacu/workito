<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Proyect;
use App\User;

class NuevoComentario extends Notification implements ShouldQueue
{
    use Queueable;

    public $proyecto;
    public $other;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( Proyect $proyecto, User $other)
    {
        $this->proyecto = $proyecto;
        $this->other = $other;
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
        ->subject('Hay nuevos comentarios.')
        ->greeting('Hola, '.$notifiable->name)
        ->line($this->other->name.' Ha hecho un nuevo comentario en el proyecto "'.$this->proyecto->nombre.'" del formas parte, te invitamos a revisarlo.')
        ->action('Ver proyecto.', url('/proyecto/show/'. $this->proyecto->id))
        ->salutation('Workito Team');
    }

        /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
        public function toArray($notifiable)
        {
            $mensaje = $this->other->name.' ha comentado en "'.$this->proyecto->nombre.'".';
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
