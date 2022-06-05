<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tramite extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'identificador',
        'nombres',
        'apellidos',
        'tipo_cedula',
        'cedula',
        'direccion',
        'telefono',
        'email',
        'pais',
        'fecha_nacimiento',
        'motivos',
        'encomienda',
        'nucleo',
        'carrera',
        'total'
    ];

    protected $casts = [
        'motivos' => 'array',
    ];

    public function getMotivosAttribute($value)
    {
        $a = json_decode($value);  
        $motivos = [];
        foreach ($a as $motivo) {
            $motivos[] = json_decode($motivo);
        }
        return $motivos;
    }

    public function cita()
    {
        return $this->hasOne(Cita::class);
    }


}
