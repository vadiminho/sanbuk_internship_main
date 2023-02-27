<?php

use App\Http\Controllers\V1\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\V1\ExperienceController;
use \App\Http\Controllers\V1\BookingController;
use \App\Http\Controllers\V1\Booking\WebhookController;

Route::prefix('/auth')->group(function () {
    Route::post('/sign-up', [UserController::class, 'signUp']);
    Route::post('/sign-in', [UserController::class, 'signIn']);
    Route::post('/verification', [UserController::class, 'verification']);
});

Route::prefix('/user')->name('user.')->middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::delete('/profile', [UserController::class, 'delete'])->name('profile.delete');
});

Route::prefix('/experiences')->group(function () {
    Route::get('/', [ExperienceController::class, 'index']);
});

Route::prefix('/bookings')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/create', [BookingController::class, 'store']);
        Route::post('/products', [BookingController::class, 'getProducts']);
        Route::post('/chargeProduct/{productId}', [BookingController::class, 'buyProductFromStripe']);
    });

    Route::prefix('/webhooks')->group(function () {
        Route::any('/charge/succeeded', [WebhookController::class, 'chargeSucceeded']);
    });
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
