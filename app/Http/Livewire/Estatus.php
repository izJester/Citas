<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tramite;

class Estatus extends Component
{
    public $search;
    public $result = 'default';

    public function render()
    {
        return view('livewire.estatus');
    }

    public function search()
    {
        $this->result = Tramite::where('identificador' , $this->search)->with('cita')->first();
    }
}
