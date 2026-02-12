<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'day',
        'startHour',
        'endHour',
        'status'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}
