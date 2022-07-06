<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Models\User;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'show'])->name('show');
Route::post('/', [App\Http\Controllers\HomeController::class, 'storePhoneNumber'])->name('store number');
Route::post('/custom', [App\Http\Controllers\HomeController::class, 'sendMessage'])->name('send message');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/home', [HomeController::class ,'upload'])->name('upload');
Route::get('/show', [UserController::class, 'show'])->name('show');
