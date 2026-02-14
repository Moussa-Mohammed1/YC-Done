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
        'stripe_payment_intent_id',
    ];

    public function Reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
