<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();


Route::middleware(['auth'])->group(function() {
    Route::get('/profil', [ProfilController::class, 'show']);

    Route::middleware(['can:isAdmin'])->group(function() {
        Route::get('/users', [UsersController::class, 'index']);
        Route::get('users/delete/{id}', [UsersController::class, 'delete']);
        
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
