<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function topMovies()
    {
        $movies = Movie::orderBy('budget', 'desc')
                        ->take(10)
                        ->get();
        return view('top_movies', compact('movies'));
    }

    public function genres()
    {
        $data = DB::table('genre')->get(); // nhớ đúng tên bảng của bạn

        return view('genres', compact('data'));
    }
}
