<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;


Route::get('/', [PredictionController::class, 'index']);