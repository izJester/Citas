<?php

namespace App\Mail;

use App\Models\Pago;
use App\Models\Tramite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TramiteRegistradoConExito extends Mailable
{
    use Queueable, SerializesModels;

    public $tramite;
    public $pago;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Tramite $tramite, Pago $pago)
    {
        $this->tramite = $tramite;
        $this->pago = $pago;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.tramite-registrado-con-exito');
    }
}
