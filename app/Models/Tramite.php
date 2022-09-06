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
        'carrera',
        'estatus',
        'total'
    ];

    protected $casts = [
        'motivos' => 'array',
    ];

    protected $hidden = [
        'stripe_id',
    ];

    protected $with = ['cita'];

    public function cita()
    {
        return $this->hasOne(Cita::class);
    }

    public function pago()
    {
        return $this->hasOne(Pago::class);
    }
}
