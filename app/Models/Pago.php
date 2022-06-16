<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'success',
        'responseCode',
        'responseMessage',
        'idLetter',
        'idNumber',
        'amount',
        'currency',
        'reference',
        'title',
        'description',
        'token',
        'transactionId',
        'paymentMethodCode',
        'paymentMethodDescription',
        'authorizationCode',
        'paymentMethodNumber',
        'paymentDate',
        'tramite_id',
    ];

    public function tramite()
    {
        return $this->belongsTo(Tramite::class);
    }
}
