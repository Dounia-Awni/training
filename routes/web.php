<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Media;
use App\Http\Controllers\ImageUploadController;
use App\Mail\welcomeMail;
use Illuminate\Support\Facades\Mail;


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


Route::get('send-mail', function ($email) {

    $details = [
        'title' => 'Test Email',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to($email)->send(new welcomeMail($details));

    dd("Email is Sent.");
});

Route::get('image-upload', [ImageUploadController::class, 'imageUpload'])->name('image.upload');
Route::post('image-upload', [ImageUploadController::class, 'imageUploadPost'])->name('image.upload.post');

Route::get('/test', [MediaController::class, 'create']);
Route::post('/', [MediaController::class, 'store']);
Route::get('/{Media}', [MediaController::class, 'show']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [App\Http\Controllers\UserAuthController::class, 'login']);
Route::get('sendSMS', [App\Http\Controllers\UserAuthController::class, 'confirm']);

Auth::routes();

Route::get('/fcm', [App\Http\Controllers\FcmController::class, 'index']);
Route::post('/store-token', [App\Http\Controllers\FcmController::class, 'storeToken'])->name('store.token');;
Route::post('/send-notification', [App\Http\Controllers\FcmController::class, 'sendNotification'])->name('send.notification');

Route::post('/home', [HomeController::class ,'upload'])->name('upload');
Route::get('/show', [UserController::class, 'show']);
Route::get('/push-notificaiton', [Controller::class, 'index']);
