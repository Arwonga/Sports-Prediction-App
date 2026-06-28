<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;


Route::get('/', [PredictionController::class, 'index']);
// Detailed Match Centre Route
Route::get('/match/{fixture}', [PredictionController::class, 'show'])->name('predictions.show');