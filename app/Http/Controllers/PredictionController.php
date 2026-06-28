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
    $leagueId = $request->query('league_id', 39); 
    $fixtures = \App\Models\Fixture::whereDate('match_at', \Carbon\Carbon::today())->get();
    
    // 1. Fetch the data
    $standings = $api->getStandings($leagueId) ?? [];

    // 2. Share it globally so the layout and sidebar can see it
    view()->share('standings', $standings);

    // 3. Just return the view with the fixtures
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