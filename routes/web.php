<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;

Route::get('/predictions/{id}', [PredictionController::class, 'show'])->name('predictions.show');


Route::get('/', [PredictionController::class, 'index']);
