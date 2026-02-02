<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = [
        'restaurant_id',
    ];

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function Plat()
    {
        return $this->hasMany(Plat::class);
    }
}
