<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\TambahFilmController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\KomenController;
use App\Http\Controllers\SukaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/', function () {
    return view('register');
});


Route::get('/profile', function () {
    return view('profile');
});

Route::get('/list', function () {
    return view('list');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/logout', function () {
    session()->forget('user');
    return redirect('/dashboard');
});


Route::post('/profile/update', [UserController::class, 'update'])->name('profile.update');


Route::post('/film/{film}/komen', [KomenController::class, 'komen'])->name('post.komen');
Route::put('/komen/{id}', [KomenController::class, 'editKomen'])->name('edit.komen');
Route::delete('/komen/{id}', [KomenController::class, 'hapusKomen'])->name('hapus.komen');

Route::get('/register', [FilmController::class, 'showRegister'])->name('register');
Route::post('/register', [FilmController::class, 'register'])->name('register.store');
Route::post('/login', [FilmController::class, 'login'])->name('login.store');
Route::post('/film/{film}/suka',[SukaController::class,'suka'])->name('sukai.film');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/genre/{id}', [DashboardController::class, 'genre'])->name('genre.show');
Route::get('/views/{id}', [TambahFilmController::class, 'view'])->name('film.view');
Route::get('/films/all', [FilmController::class, 'showAll'])->name('films.all');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('forgot');
// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.send');

Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');


Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/managefilm', [TambahFilmController::class, 'tambah'])->name('get.tambah');
    Route::post('/managefilm', [TambahFilmController::class, 'tambahFilm'])->name('post.tambah');
    Route::delete('/managefilm/{id}', [TambahFilmController::class, 'delete'])->name('hapus.film');
    Route::get('/managefilm/{id}/{judul}', [TambahFilmController::class, 'edit'])->name('get.edit');
    Route::put('/managefilm/{id}', [TambahFilmController::class, 'edit_film'])->name('put.edit');    
    Route::get('/report', [KomenController::class, 'daftarLapor'])->name('report');
    Route::delete('/report/{id}', [KomenController::class, 'hapusKomenLapor'])->name('hapus.komen.lapor');
});

Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
    // Route::get('/dashboard', [TambahFilmController::class, 'dashboardUser'])->name('dashboard');
    Route::get('/libraries', function () {
    return view('libraries');
    });
    Route::get('/favorites', [SukaController::class, 'filmKesukaan'])->name('film.disukai');
    Route::post('/komen/{id}/report', [KomenController::class, 'lapor'])->name('lapor.komen');
});