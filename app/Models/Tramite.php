<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Laravel\Cashier\Billable;
use App\Traits\Uuid;

class Tramite extends Model
{
    use HasFactory;
    use Searchable;
    use Billable;
    use Uuid;

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
        'fecha_egreso',
        'motivos',
        'encomienda',
        'nucleo',
        'total'
    ];

    protected $casts = [
        'motivos' => 'array',
    ];

    public function cita()
    {
        return $this->hasOne(Cita::class);
    }


}
