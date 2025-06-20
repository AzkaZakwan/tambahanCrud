<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['genre'];

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_genre');
    }

 
}
