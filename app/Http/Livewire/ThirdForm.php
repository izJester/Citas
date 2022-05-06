<?php

namespace App\Http\Livewire;

use App\Models\Tramite;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\TramiteRegistradoConExito;

class ThirdForm extends Component
{
    public Tramite $tramite;

    protected $listeners = ['token' => 'purchase'];


    public function purchase($value)
    {
        \Stripe\Stripe::setApiKey( config('stripe.key') );
        try {
            $charge = \Stripe\Charge::create([
                'amount' => (int) $this->tramite->total,
                'currency' => 'usd',
                'description' => 'Tramite',
                'source' => $value['token']['id'],
              ]);
        } catch (\Stripe\Exception\CardException $e) {
            dd($e->getMessage());
        }
        catch (\Stripe\Exception\InvalidRequestException $e) {
            dd($e->getMessage());
        }
        
          if ($charge->status == 'succeeded') {
            Mail::to($this->tramite->email)->send(new TramiteRegistradoConExito($this->tramite));
            dd('Tramite realizado con exito');
        }
    }

    public function render()
    {
        return view('livewire.third-form');
    }
}
