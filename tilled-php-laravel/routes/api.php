<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});

Route::get('/secret/{id}', 'App\Http\Controllers\PaymentController@createPaymentIntent');