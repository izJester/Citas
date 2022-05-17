<?php

namespace App\Mail;

use App\Models\Tramite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TramiteRegistradoConExito extends Mailable
{
    use Queueable, SerializesModels;

    public $tramite;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Tramite $tramite , $url)
    {
        $this->tramite = $tramite;
        $this->url = $url;
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
