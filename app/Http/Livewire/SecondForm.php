<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Temporal;

class SecondForm extends Component
{
    public $identificador;
    public $temporal;

    public function mount()
    {
        $this->temporal = Temporal::where('identificador', $this->identificador)->first();
    }
    
    public function render()
    {
        return view('livewire.second-form');
    }

    public function save()
    {
        $this->validate();

        $this->temporal->update([
            
        ]);

        session()->flash('message', 'Se ha creado una solicitud temporal');

        return redirect()->route('temporal.index');
        
    }
}
