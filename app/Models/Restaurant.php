<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table = 'restaurants';
    protected $fillable = [
        'user_id',
        'nom',
        'status',
        'localisation',
        'typeCuisine_id',
        'capacite',
    ];

    public function typeCuisine()
    {
        return $this->belongsTo(TypeCuisine::class, 'typeCuisine_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function horaires()
    {
        return $this->hasMany(Horaire::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoris()
    {
        return $this->hasMany(Favoris::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    
}
