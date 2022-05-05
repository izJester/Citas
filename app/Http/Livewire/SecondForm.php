<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tramite;

class SecondForm extends Component
{
    public Tramite $tramite;
    public $show_enco = false;
    public $type;
    public $nacionales;
    public $internacionales;
    public $motivos = [];
    public $encomienda;
    public $total;


    public function mount()
    {
        $this->nacionales = [
            ['id' => '1', 'nombre' => 'Impresion Certificado' , 'price' => '0.427'],
            ['id' => '2', 'nombre' => 'Record Academico' , 'price' => '0.53'],
            ['id' => '3', 'nombre' => 'Notas Certificadas' , 'price' => '0.012'],
            ['id' => '4', 'nombre' => 'Constancia de Culminacion' , 'price' => '0.427'],
            ['id' => '5', 'nombre' => 'Certificacion de Programa' , 'price' => '0.427'],
            ['id' => '6', 'nombre' => 'Certificacion de Cursos Comunitarios' , 'price' => '0.427'],
        ];

        $this->internacionales = [
            ['id' => '1', 'nombre' => 'Impresion Certificado' , 'price' => '0.57'],
            ['id' => '2', 'nombre' => 'Record Academico' , 'price' => '0.80'],
            ['id' => '3', 'nombre' => 'Notas Certificadas' , 'price' => '0.1'],
            ['id' => '4', 'nombre' => 'Constancia de Culminacion' , 'price' => '0.57'],
            ['id' => '5', 'nombre' => 'Certificacion de Programa' , 'price' => '0.57'],
            ['id' => '6', 'nombre' => 'Certificacion de Cursos Comunitarios' , 'price' => '0.57'],
        ];
        
    }
    
    public function render()
    {
        return view('livewire.second-form');
    }

    public function updatedMotivos()
    {
        $this->show_enco = true;
    }

    public function calculateTotal()
    {
        $total = 0;
        foreach ($this->motivos as $motivo) {
            $step = json_decode($motivo);
            $total += $step->price;
        }
        if ($this->encomienda) {
            $total += 0.1;
        }

        $this->total = number_format($total * 256.48 , 2 , ',' , '.');

        return $total;
    }

    public function save()
    {
        $this->tramite->update([

            'motivos' => $this->motivos,
            'encomienda' => $this->encomienda,
            'total' => $this->total,
        ]);

        session()->flash('message', 'Paso dos realizado');

        return redirect()->route('temporary.create_third' , ['identf' => $this->tramite->identificador]);
        
    }
}
