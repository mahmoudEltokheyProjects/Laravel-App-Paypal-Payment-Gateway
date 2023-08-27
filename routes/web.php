<?php

use App\Http\Controllers\PayPalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// +++++++++++++++++++++++++ Paypal Payment +++++++++++++++++++++++++
// Payment Process
Route::get('payment', [PayPalController::class,'payment'] )->name('payment');
// If Payment is "Successful"
Route::get('success', [PayPalController::class,'success'])->name('payment.success');
// Cancel Payment
Route::get('cancel', [PayPalController::class,'cancel'])->name('payment.cancel');

 