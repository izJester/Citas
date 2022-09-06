<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'tramite_id',
        'fecha',
    ];


    public function tramite()
    {
        return $this->belongsTo(Tramite::class);
    }
}
