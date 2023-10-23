<?php

use App\Http\Livewire\HabilitiesController;
use App\Models\User;
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
    $users = User::with('habilities')->get();
    return view('welcome', compact('users'));
})->name('welcome');

Route::get('/usuarios', function () {
    $users = User::with('habilities')->get();
    return view('users', compact('users'));
})->name('users');

Route::get('/contactanos', function () {
    return view('contac',);
})->name('contac');

Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::get('/habilidades', HabilitiesController::class)->name('habilidades');
    Route::get('/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');
});

