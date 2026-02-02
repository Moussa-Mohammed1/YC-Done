<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horaire extends Model
{
    use HasFactory;

    protected $table = 'horaires';
    protected $fillable = [
        'jourSemaine',
        'heureOuverture',
        'heureFermeture',
    ];

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
