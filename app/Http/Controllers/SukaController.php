<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\User;


class SukaController extends Controller
{
    public function suka(Film $film)
    {
        if(!session()->has('user')){
            return redirect()->route('login')->with('error', 'Harap login');
        }
        
        $session    = session('user')['id'];
        $user       = User::findOrFail($session);

        if (!$user->sukaFilm()->where('film_id',$film->id)->exists()){
            $user->sukaFilm()->attach($film->id);
        }

        return back();
    }

    public function filmKesukaan(){
        if(!session()->has('user')){
            return redirect()->route('login')->with('error', 'Harap login');
        }

        $session    = session('user')['id'];
        $user       = User::findOrFail($session);

        $films = $user->sukaFilm()->get();

        return view('favorites', compact('films'));
    }

}
