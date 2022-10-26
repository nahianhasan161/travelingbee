<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/forget-password', [PasswordController::class,'forgetPassword'])->name('password.email');
Route::post('/reset-password', [PasswordController::class,'reset'])->name('password.reset');

Route::post('/email/verification-notification', [EmailVerificationController::class,'sendVerificationEmail'])->middleware('auth:sanctum');
Route::post('/email/verify/{id}/{hash}', [EmailVerificationController::class,'verify']
)->name('verification.verify')->middleware('auth:sanctum');






Route::controller(AuthController::class)->group(function(){
    Route::post('/login','login')->name('login');
    Route::post('/register','register');
    Route::post('/auth/user','authUser')->middleware('auth:sanctum');
    Route::post('/alluser','allUser');
    Route::put('/user/{user}','update');
    Route::delete('/user/{user}','destroy');
     /* Route::get('/user','authUser')->middleware('auth:sanctum');  */
});

Route::resource('/posts', PostController::class);
Route::resource('/roles', RoleController::class);

Route::resource('/place', PlaceController::class);
Route::resource('/category', CategoryController::class);

Route::resource('/booking',BookingController::class);

