<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Temporal extends Model
{
    use HasFactory;

    protected $fillable = [
        'identificador',
        'nombres',
        'apellidos',
        'tipo_cedula',
        'cedula',
        'direccion',
        'telefono',
        'email',
        'fecha_nacimiento',
        'motivos',
        'encomienda',
        'nucleo',
        'total'
    ];

    protected $casts = [
        'motivos' => 'array',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }
}
