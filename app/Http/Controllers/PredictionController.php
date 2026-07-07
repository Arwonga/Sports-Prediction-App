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
        // Catch the active filters
        $leagueId = $request->query('league_id', 39); 
        $date = $request->query('date', \Carbon\Carbon::today()->format('Y-m-d'));

        // Fetch Right Sidebar Data
        $standings = $api->getStandings($leagueId) ?? [];
        $featuredMatches = \App\Models\Fixture::with(['homeTeam', 'awayTeam'])
            ->whereDate('match_at', \Carbon\Carbon::today())
            ->take(2)
            ->get();

        view()->share('standings', $standings);
        view()->share('featuredMatches', $featuredMatches);

        // Fetch Center Table Data (Filtered strictly by Date ONLY to avoid the SQL crash)
        $fixtures = \App\Models\Fixture::with(['homeTeam', 'awayTeam', 'prediction'])
            ->whereDate('match_at', $date)
            ->get();

        return view('predictions.index', compact('fixtures', 'leagueId', 'date'));
    }
    /**
     * Display the detailed Match Centre for a specific fixture.
     */
    public function show($id)
    {
    // Fetch the fixture with its related teams and calculated prediction engine records
    $fixture = Fixture::with(['homeTeam', 'awayTeam', 'prediction'])->findOrFail($id);

    // Return the detailed analysis template
    return view('predictions.show', compact('fixture'));
    }
}