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

    public function TypeCuisine()
    {
        return $this->belongsTo(TypeCuisine::class, 'typeCuisine_id');
    }

    public function Photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function Horaire()
    {
        return $this->hasMany(Horaire::class);
    }

    public function Menu()
    {
        return $this->hasMany(Menu::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Favoris()
    {
        return $this->hasMany(Favoris::class);
    }
    
}
