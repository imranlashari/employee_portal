<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::group(['middleware' => 'prevent-back-history'],function(){

    Route::middleware(['auth:sanctum', 'is_admin'])->get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
        return Inertia::render('Home/Home');
    })->name('home');

    Route::middleware(['auth:sanctum', 'verified'])->get('/clockin', [UserController::class, 'clockin'])->name('clockin');
    Route::middleware(['auth:sanctum', 'verified'])->get('/clockout', [UserController::class, 'clockout'])->name('clockout');


});


