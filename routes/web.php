<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Media;


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



Route::get('/', 'MediaController@create');
Route::post('/', 'MediaController@store');
Route::get('/{Media}', 'MediaController@show');

Route::get('/', function () {
    return view('welcome');
});



// Route::get('login', [App\Http\Controllers\UserAuthController::class, 'login']);
// Route::get('sendSMS', [App\Http\Controllers\UserAuthController::class, 'confirm']);

// Auth::routes();




Route::get('/push-notificaiton', [NotificationController::class, 'index']);
Route::post('/store-token', [NotificationController::class, 'storeToken']);
Route::post('/send-notification', [NotificationController::class, 'sendNotification']);



Route::post("store", [UserController::class], 'store');
Route::get("show", [UserController::class], 'show');



