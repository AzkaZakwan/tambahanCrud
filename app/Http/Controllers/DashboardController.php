<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Models\Genre;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $genreId = $request->query('genre_id');

        // Ambil semua genre untuk dropdown dan loop tampilan
        $genres = Genre::with('films')->get();

        // Untuk pencarian atau filter genre
        if ($search) {
            $films = Film::where('judul', 'like', "%{$search}%")->get();
        } elseif ($genreId) {
            $films = Genre::findOrFail($genreId)->films;
        } else {
            $films = Film::with('genres')->get();
        }

        return view('dashboard', [
            'films' => $films,
            'genres' => $genres,
        ]);
    }

    public function genre($id)
    {
        $genre = Genre::with('films')->findOrFail($id);
        $films = $genre->films;

        return view('genre', compact('genre', 'films'));
    }
}

