<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

Route::get('/predictions/{id}', [PredictionController::class, 'show'])->name('predictions.show');

Route::get('/', [PredictionController::class, 'index']);

Route::get('/language/{locale}', function ($locale) {
    // English, Spanish, French, Mandarin, Arabic, Portuguese, Swahili
    $validLocales = ['en', 'es', 'fr', 'zh', 'ar', 'pt', 'sw'];
    
    if (in_array($locale, $validLocales)) {
        Session::put('locale', $locale);
    }
    
    return Redirect::back();
})->name('language.switch');
