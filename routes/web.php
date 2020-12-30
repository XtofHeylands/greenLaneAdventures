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

Route::group(['prefix' => 'auth', 'middleware' => 'cors'], function() {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/search/tracks', [TrackController::class, 'search'])->name('search');

Route::resource('tracks', TrackController::class);
//GET 	        /tracks 	            index 	    tracks.index
//GET 	        /tracks/create 	        create 	    tracks.create
//POST 	        /tracks 	            store 	    tracks.store
//GET 	        /tracks/{track} 	    show 	    tracks.show
//GET 	        /tracks/{track}/edit 	edit 	    tracks.edit
//PUT/PATCH 	/tracks/{track} 	    update 	    tracks.update
//DELETE 	    /tracks/{track} 	    destroy 	tracks.destroy

