<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'day',
        'personnes',
        'startHour',
        'endHour',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
