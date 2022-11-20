<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\GroupTourController;
use App\Http\Controllers\ReviewController;
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
/* start Guest */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/forget-password', [PasswordController::class,'forgetPassword'])->name('password.email');
Route::post('/reset-password', [PasswordController::class,'reset'])->name('password.reset');

Route::post('/email/verification-notification', [EmailVerificationController::class,'sendVerificationEmail'])->middleware('auth:sanctum');
Route::post('/email/verify/{id}/{hash}', [EmailVerificationController::class,'verify']
)->name('verification.verify')->middleware('auth:sanctum');

/* end Guest */

/* start User */

Route::controller(AuthController::class)->group(function(){
    Route::post('/login','login')->name('login');
    Route::post('/register','register');
    Route::post('/auth/user','authUser')->middleware('auth:sanctum');
    Route::post('/alluser','allUser');
    Route::put('/user/{user}','update');
    Route::delete('/user/{user}','destroy');
    /* Route::get('/user','authUser')->middleware('auth:sanctum');  */
});
/* END User */
/* start order,post,role */

Route::resource('/orders', OrderController::class);
Route::get('/orders/user/{id}',[OrderController::class,'orderShow']);
Route::resource('/posts', PostController::class);
Route::resource('/roles', RoleController::class);
/* END order */
/* start place&booking */

Route::resource('/place', PlaceController::class);
Route::resource('/category', CategoryController::class);

Route::resource('/booking',BookingController::class);
Route::get('/booking/user/{id}', [BookingController::class, 'userBookingDetails']); 
Route::post('/place/bookings/by', [BookingController::class, 'getBookingBy']); 
Route::post('/place/details/{place}', [BookingController::class, 'BookingDetails']); 
Route::get('/manage/place/{place}/booking/all', [BookingController::class, 'BookingByUser']); 
Route::post('/place/payments', [BookingController::class, 'payments']); 

/* END place&booking */


Route::resource('/review',ReviewController::class);
Route::post('/review/place/{id}',[ReviewController::class,'storeByPlace']);
Route::resource('/group-tour',GroupTourController::class);
Route::resource('/group-tour/plan',PlanController::class);








//Address Start
Route::resource('/address/division', DivisionController::class);
Route::resource('/address/district', DistrictController::class);
Route::resource('/address/area', AreaController::class);

//Address End
//SSLCOMMERZ Start
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']); 
//SSLCOMMERZ END