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
        // 1. Fetch the Core Match with its vital relationships
        $fixture = Fixture::with(['homeTeam', 'awayTeam', 'prediction'])->findOrFail($id);

        // 2. Fetch Head-to-Head (H2H) Data
        $h2h = Fixture::with(['homeTeam', 'awayTeam'])
            ->where(function ($query) use ($fixture) {
                $query->where('home_team_id', $fixture->home_team_id)
                      ->where('away_team_id', $fixture->away_team_id);
            })
            ->orWhere(function ($query) use ($fixture) {
                $query->where('home_team_id', $fixture->away_team_id)
                      ->where('away_team_id', $fixture->home_team_id);
            })
            ->where('match_at', '<', $fixture->match_at)
            ->whereNotNull('home_score') 
            ->orderBy('match_at', 'desc')
            ->take(10) 
            ->get();

        // 3. Fetch Home Team Recent Form
        $homeTeamForm = Fixture::with(['homeTeam', 'awayTeam'])
            ->where(function ($query) use ($fixture) {
                $query->where('home_team_id', $fixture->home_team_id)
                      ->orWhere('away_team_id', $fixture->home_team_id);
            })
            ->where('match_at', '<', $fixture->match_at)
            ->whereNotNull('home_score')
            ->orderBy('match_at', 'desc')
            ->take(6)
            ->get();

        // 4. Fetch Away Team Recent Form
        $awayTeamForm = Fixture::with(['homeTeam', 'awayTeam'])
            ->where(function ($query) use ($fixture) {
                $query->where('home_team_id', $fixture->away_team_id)
                      ->orWhere('away_team_id', $fixture->away_team_id);
            })
            ->where('match_at', '<', $fixture->match_at)
            ->whereNotNull('home_score')
            ->orderBy('match_at', 'desc')
            ->take(6)
            ->get();

        // 5. Attach the dynamic arrays directly to the $fixture object 
        $fixture->h2h = $h2h;
        $fixture->homeTeamForm = $homeTeamForm;
        $fixture->awayTeamForm = $awayTeamForm;
        
        // Standings
        $fixture->homeStandings = [];
        $fixture->awayStandings = [];

        return view('predictions.show', compact('fixture'));
    }
}