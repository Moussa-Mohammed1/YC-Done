<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCuisine extends Model
{
    use HasFactory;
    protected $fillable = [
        'titre'
    ]; 
    public function Restaurant()
    {
        return $this->belongsToMany(Restaurant::class, 'typeCuisine_id');
    }
}
