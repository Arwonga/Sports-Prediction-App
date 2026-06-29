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
    public function index(Request $request, \App\Services\SportsApiService $api)
    {
        // 1. Catch the league ID from the URL, default to 39 (England Premier League)
        $leagueId = $request->query('league_id', 39); 
        
        // 2. Fetch live standings based on the selected league, defaulting to empty array if none exist
        $standings = $api->getStandings($leagueId) ?? [];
        
        // 3. Automatically pick 2 Featured Matches for today
        $featuredMatches = \App\Models\Fixture::with(['homeTeam', 'awayTeam'])
            ->whereDate('match_at', \Carbon\Carbon::today())
            ->take(2)
            ->get();

        // 4. Share data globally so the left and right sidebars can always access them
        view()->share('standings', $standings);
        view()->share('featuredMatches', $featuredMatches);

        // 5. Fetch the main table fixtures for today
        $fixtures = \App\Models\Fixture::with(['homeTeam', 'awayTeam', 'prediction'])
            ->whereDate('match_at', \Carbon\Carbon::today())
            ->get();

        return view('predictions.index', compact('fixtures'));
    }
    /**
     * Display the detailed Match Centre for a specific fixture.
     */
    public function show(Fixture $fixture)
    {
        // Ensure we load the teams and the prediction data
        $fixture->load(['homeTeam', 'awayTeam', 'prediction']);

        return view('predictions.show', compact('fixture'));
    }
}