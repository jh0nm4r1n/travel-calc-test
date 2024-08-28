<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;

Route::get('/', function () {
    return view('index');
});

Route::get('/', [TravelController::class, 'index']);
Route::post('/calculate', [TravelController::class, 'calculate']);
