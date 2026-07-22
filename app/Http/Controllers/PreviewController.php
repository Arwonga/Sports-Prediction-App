<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PreviewController extends Controller
{
    public function index()
    {
        // Fetch today's matches sorted by the model's highest confidence,
        // surfacing the biggest high-probability games automatically.
        $previews = Fixture::with(['prediction', 'homeTeam', 'awayTeam'])
            ->whereDate('match_at', Carbon::today())
            ->join('predictions', 'fixtures.id', '=', 'predictions.fixture_id')
            ->orderBy('predictions.confidence', 'desc')
            ->select('fixtures.*')
            ->take(6)
            ->get();

        return view('features.previews', compact('previews'));
    }
}