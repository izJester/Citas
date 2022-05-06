<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tramite;

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
           dd('Tramite realizado con exito');
        }
    }

    public function render()
    {
        return view('livewire.third-form');
    }
}
