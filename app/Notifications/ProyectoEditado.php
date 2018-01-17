<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Proyect;

class ProyectoEditado extends Notification implements ShouldQueue
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
        if($this->proyecto->isTerminado()){
            $message = 'Se ha cambiado el estado del proyecto "' .$this->proyecto->nombre . '" a proyecto terminado, enhorabuena.';
        } else {
            $message = 'Se ha cambiado el estado del proyecto "' .$this->proyecto->nombre . '" a proyecto en desarrollo.';
        }
        return (new MailMessage)
        ->subject('Cambios en '. $this->proyecto->nombre.'.')
        ->greeting('Hola, '.$notifiable->name)
        ->line($message)
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
        if( $this->proyecto->isTerminado() ){
            $mensaje = 'El proyecto "'.$this->proyecto->nombre.'" ha sido terminado!';
        } else {
            $mensaje = 'El proyecto "'.$this->proyecto->nombre.'" ha vuelto a desarrollo!';
        }
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
