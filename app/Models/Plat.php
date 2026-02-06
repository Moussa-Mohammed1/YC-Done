<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;
    protected $table = 'plats';

    protected $fillable = [
        'contenu',
        'prix',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
