<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\TrendController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\LivescoreController;
use App\Http\Controllers\InjuredPlayerController;
use App\Http\Controllers\TeamComparisonController;
use App\Http\Controllers\SettingsController;

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

Route::get('/previews', [PreviewController::class, 'index'])->name('features.previews');

Route::get('/livescores', [LivescoreController::class, 'index'])->name('features.livescores');

Route::get('/injured-players', [InjuredPlayerController::class, 'index'])->name('features.injured-players');

Route::get('/team-comparison', [TeamComparisonController::class, 'index'])->name('features.team-comparison');

// Settings & Preferences
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
Route::post('/settings/auto-timezone', [SettingsController::class, 'autoDetectTimezone'])->name('settings.auto-timezone');