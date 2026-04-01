<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MovieController;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/top-runtime', function () {
    $movies = DB::table('movie')->where('runtime', '>', 120)->limit(10)->get();
    return view('top_runtime', compact('movies'));
});

Route::get('/top-vote', function () {
    $movies = DB::table('movie')->orderByDesc('vote_average')->limit(10)->get();
    return view('top_vote', compact('movies'));

});

Route::get('/phannguyenkhoinguyen', function () {
    return "Phan Nguyễn Khôi Nguyên";
});

Route::get('/doanphucgiakhanh', function () {
    return 'Doan Phuc Gia Khanh';
});


Route::get('/phuchibang', function () {
    return "Phu Chi Bang";
});

Route::get('/nguyentuandung', function () {
    return "Nguyen Tuan Dung";
});


Route::get('/top-movies', [MovieController::class, 'topMovies']);
Route::get('/genres', [MovieController::class, 'genres']);

Route::get('/test', function () {
    return view('test');
});
Route::get('/sach', function () {
    $sach = DB::table('sach')->get();
    $theloai = DB::table('dm_the_loai')->get();
    return view('danh_sach_sach', compact('sach', 'theloai'));
});

Route::get('/theloai/{id}', function ($id) {
    $sach = DB::table('sach')->where('the_loai', $id)->get();
    $theloai = DB::table('dm_the_loai')->get();
    $tentheloai = DB::table('dm_the_loai')->where('id', $id)->first();
    return view('danh_sach_sach', compact('sach', 'theloai', 'tentheloai'));
});
Route::get('/sach/{id}', function ($id) {
    $sach = DB::table('sach')->where('id', $id)->first();
    return view('chi_tiet_sach', compact('sach'));
});
