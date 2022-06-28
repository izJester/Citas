<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Cita;
use Illuminate\Queue\SerializesModels;

class CrearCitaTramite extends Mailable
{
    use Queueable, SerializesModels;

    public $cita;
    public $tramite;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cita $cita)
    {
        $this->cita = $cita;
        $this->tramite = $cita->tramite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.cita-creada');
    }
}
