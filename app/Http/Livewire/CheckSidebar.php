<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckSidebar extends Component
{
    public $step;
    
    public function render()
    {
        return view('livewire.check-sidebar');
    }
}
