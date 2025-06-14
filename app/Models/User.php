<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    public function komentar()
    {
        return $this->hasMany(Komen::class);
    }
    public function sukaFilm()
    {
        return $this->belongsToMany(Film::class, 'sukai')->withTimestamps();
    }
}
