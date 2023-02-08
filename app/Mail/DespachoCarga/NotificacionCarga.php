<?php

namespace App\Mail\DespachoCarga;

use App\Models\Carga;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionCarga extends Mailable
{
    use Queueable, SerializesModels;

    public $carga;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Carga $carga)
    {
        $this->carga = $carga;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notificacion_carga')->subject('Notificación de despacho de carga');
    }
}
