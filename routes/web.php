<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/browse', [TrackController::class, 'index'])->name('browse');
Route::get('/add-track', [TrackController::class, 'create'])->name('create');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::post('/add-track', [TrackController::class, 'store'])->name('track.store');
