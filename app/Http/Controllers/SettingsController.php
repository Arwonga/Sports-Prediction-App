<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // 1. Handle manual saves when the user clicks the "Save" button in the menu
    public function update(Request $request)
    {
        $request->validate([
            'timezone' => 'nullable|string',
            'coef_format' => 'nullable|string',
        ]);

        if ($request->has('timezone')) {
            session(['timezone' => $request->timezone]);
        }

        if ($request->has('coef_format')) {
            session(['coef_format' => $request->coef_format]);
        }

        // Redirect back to the page they were on so the new times render immediately
        return back();
    }

    // 2. Handle the silent auto-detection on first visit
    public function autoDetectTimezone(Request $request)
    {
        // Only update if they haven't manually set a timezone yet
        if (!session()->has('timezone') && $request->has('timezone')) {
            session(['timezone' => $request->timezone]);
            return response()->json(['status' => 'success']);
        }
        
        return response()->json(['status' => 'already_set']);
    }
}