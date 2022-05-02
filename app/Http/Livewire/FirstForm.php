<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Temporal;
use App\Http\Controllers\TemporalController;
use Illuminate\Support\Str;

class FirstForm extends Component
{
    public $identificador;
    public $nombres;
    public $apellidos;
    public $tipo_cedula;
    public $cedula;
    public $direccion;
    public $telefono;
    public $email;
    public $fecha_nacimiento;

    protected $rules = [
        'nombres' => 'required',
        'apellidos' => 'required',
    ];


    public function render()
    {
        return view('livewire.first-form');
    }

    public function mount()
    { 
        $attempt = Str::random(9);
        if (Temporal::where('identificador', $attempt)->exists()) {
            $this->identificador = Str::random(9);
        } else {
            $this->identificador = $attempt;
        }
    }

    public function store()
    {
        $this->validate();

        $temporal = Temporal::create([
            'identificador' => $this->identificador,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'tipo_cedula' => $this->tipo_cedula,
            'cedula' => $this->cedula,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'fecha_nacimiento' => $this->fecha_nacimiento,

        ]);

        session()->flash('message', 'Primer Paso Realizado');

        return redirect()->route('temporary.create_second', ['identf' => $temporal->identificador]);
        
    }
}
