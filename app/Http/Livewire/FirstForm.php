<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tramite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Squire\Models\Country;

class FirstForm extends Component
{
    public $paises;
    public $pais;
    public $nombres;
    public $apellidos;
    public $tipo_cedula;
    public $cedula;
    public $direccion;
    public $telefono;
    public $email;
    public $fecha_nacimiento;
    public $nucleo;
    public $carrera;

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
        $this->paises = Country::all();
    }

    public function store()
    {
        $this->validate();

        $tramite = Tramite::create([
            'identificador' => session('code'),
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'tipo_cedula' => $this->tipo_cedula,
            'cedula' => $this->cedula,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'pais' => $this->pais,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'nucleo' => $this->nucleo,
            'carrera' => $this->carrera,

        ]);

        session()->flash('message', 'Primer Paso Realizado');
        session(['firstStep' => true]);
        $url = URL::signedRoute('temporary.create_second');
        return redirect($url);
        
    }

}
