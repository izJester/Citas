<?php

namespace App\Http\Livewire;

use App\Models\Tramite;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\TramiteRegistradoConExito;

class ThirdForm extends Component
{
    public $tramite;

    protected $listeners = ['token' => 'purchase'];

    public function mount()
    {
        $this->tramite = Tramite::where('identificador' , session('code'))->first();
    }


    public function purchase($value)
    {
        \Stripe\Stripe::setApiKey( config('stripe.key') );
        try {
            $charge = \Stripe\Charge::create([
                'amount' => round(str_replace( ',' , '' , $this->tramite->total) / 4.95),
                'currency' => 'usd',
                'description' => 'Tramite',
                'source' => $value['token']['id'],
              ]);
        } catch (\Stripe\Exception\CardException $e) {
            dd($e);
        }
        catch (\Stripe\Exception\InvalidRequestException $e) {
            dd($e);
        }
        
          if ($charge->status == 'succeeded') {
            session()->flush();
            Mail::to($this->tramite->email)->send(new TramiteRegistradoConExito($this->tramite, $charge->receipt_url));
            return redirect('/success');
        }
    }

    public function render()
    {
        return view('livewire.third-form');
    }
}
