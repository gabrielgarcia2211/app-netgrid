<?php

use Illuminate\Support\Facades\Route;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\PokemonController::class, 'index'])->name('home');


Route::group(['prefix' => 'pokemons', 'middleware' => 'auth'], function () {
    Route::get('/get/{name?}', [App\Http\Controllers\PokemonController::class, 'get_pokemon'])->name('pokemons.get');
    Route::get('/list', [App\Http\Controllers\PokemonController::class, 'list_pokemons'])->name('pokemons.list');
    Route::get('/details/{name?}', [App\Http\Controllers\PokemonController::class, 'details_pokemons'])->name('pokemons.details');
    Route::post('/favorites', [App\Http\Controllers\PokemonController::class, 'favorites_pokemons'])->name('pokemons.favorites');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::post('/edit', [App\Http\Controllers\UserController::class, 'edit_user'])->name('user.edit');
    Route::get('/pdf/favorites', [App\Http\Controllers\UserController::class, 'pdf_favorites'])->name('user.favorites');
});
