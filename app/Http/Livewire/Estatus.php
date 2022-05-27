<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tramite;

class Estatus extends Component
{
    public $search;
    public $result;

    protected $rules = [
        'search' => 'required',
    ];

    public function render()
    {
        return view('livewire.estatus');
    }

    public function search()
    {
        $this->validate();

        $this->result = Tramite::search($this->search)->first();
    }
}
