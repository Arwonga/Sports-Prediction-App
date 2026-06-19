<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;
use Carbon\Carbon;

class PredictionController extends Controller
{
    /**
     * Display the dashboard with today's predictions.
     */
    public function index()
    {
        // Fetch today's fixtures along with their teams and calculated predictions
        $fixtures = Fixture::with(['homeTeam', 'awayTeam', 'prediction'])
            ->whereDate('match_at', Carbon::today())
            ->whereHas('homeTeam', function ($query) {
                // Filtering out unwanted teams from specific regions
                $query->whereNotIn('name', ['Al Nassr', 'Al Hilal', 'Al Ittihad', 'Al Ahli Saudi', 'Al Shabab']);
            })
            ->orderBy('match_at', 'asc')
            ->get();

        return view('predictions.index', compact('fixtures'));
    }
}