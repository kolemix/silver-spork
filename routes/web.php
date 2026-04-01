<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
use Illuminate\Support\Facades\Auth;

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

Route::get('/accountpanel', 'App\Http\Controllers\AccountController@accountpanel')
    ->middleware('auth')
    ->name('account');

Route::post('/saveaccountinfo', 'App\Http\Controllers\AccountController@saveaccountinfo')
    ->middleware('auth')
    ->name('saveinfo');
Route::get('/admin/sach', function () {
    if (Auth::user()->role !== 'admin') {
        return redirect('/sach');
    }
    $sach = DB::table('sach')
        ->join('dm_the_loai', 'sach.the_loai', '=', 'dm_the_loai.id')
        ->select('sach.*', 'dm_the_loai.ten_the_loai')
        ->get();
    return view('admin.quan_ly_sach', compact('sach'));
})->middleware('auth');

Route::get('/admin/sach/them', function () {
    if (Auth::user()->role !== 'admin') {
        return redirect('/sach');
    }
    $theloai = DB::table('dm_the_loai')->get();
    return view('admin.them_sach', compact('theloai'));
})->middleware('auth');

Route::post('/admin/sach/them', function () {
    if (Auth::user()->role !== 'admin') {
        return redirect('/sach');
    }
    DB::table('sach')->insert([
        'tieu_de' => request('tieu_de'),
        'tac_gia' => request('tac_gia'),
        'nha_xuat_ban' => request('nha_xuat_ban'),
        'nha_cung_cap' => request('nha_cung_cap'),
        'hinh_thuc_bia' => request('hinh_thuc_bia'),
        'mo_ta' => request('mo_ta'),
        'link_anh_bia' => request('link_anh_bia'),
        'gia_ban' => request('gia_ban'),
        'the_loai' => request('the_loai'),
    ]);
    return redirect('/admin/sach');
})->middleware('auth');

Route::get('/admin/sach/sua/{id}', function ($id) {
    if (Auth::user()->role !== 'admin') {
        return redirect('/sach');
    }
    $sach = DB::table('sach')->where('id', $id)->first();
    $theloai = DB::table('dm_the_loai')->get();
    return view('admin.sua_sach', compact('sach', 'theloai'));
})->middleware('auth');

Route::post('/admin/sach/sua/{id}', function ($id) {
    if (Auth::user()->role !== 'admin') {
        return redirect('/sach');
    }
    DB::table('sach')->where('id', $id)->update([
        'tieu_de' => request('tieu_de'),
        'tac_gia' => request('tac_gia'),
        'nha_xuat_ban' => request('nha_xuat_ban'),
        'nha_cung_cap' => request('nha_cung_cap'),
        'hinh_thuc_bia' => request('hinh_thuc_bia'),
        'mo_ta' => request('mo_ta'),
        'link_anh_bia' => request('link_anh_bia'),
        'gia_ban' => request('gia_ban'),
        'the_loai' => request('the_loai'),
    ]);
    return redirect('/admin/sach');
})->middleware('auth');

Route::get('/admin/sach/xoa/{id}', function ($id) {
    if (Auth::user()->role !== 'admin') {
        return redirect('/sach');
    }
    DB::table('sach')->where('id', $id)->delete();
    return redirect('/admin/sach');
})->middleware('auth');

require __DIR__.'/auth.php';

Route::get('/api/sach-theo-theloai/{id}', function ($id) {
    $sach = DB::table('sach')->where('the_loai', $id)->get();
    return response()->json($sach);
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect('/admin/sach');
    }
    return redirect('/sach');
})->middleware('auth')->name('dashboard');
