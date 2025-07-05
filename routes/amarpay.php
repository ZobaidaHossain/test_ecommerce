<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::post('/amarpay/success', [PaymentController::class, 'success']);
Route::post('/amarpay/fail', [PaymentController::class, 'fail']);
Route::post('/amarpay/cancel', [PaymentController::class, 'cancel']);
