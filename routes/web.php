<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\TrendController;

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

Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

// More Menu Routes
Route::get('/trends', [TrendController::class, 'index'])->name('features.trends');