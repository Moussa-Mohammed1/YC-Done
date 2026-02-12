<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiements';
    protected $fillable = [
        'montant',
        'reservation_id',
        'status',
    ];

    public function Reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
