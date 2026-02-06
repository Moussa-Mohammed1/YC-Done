<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table =  'photos';
    protected $fillable = [
        'contenu',
        'restaurant_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
