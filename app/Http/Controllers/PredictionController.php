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
    public function index(Request $request, \App\Services\SportsApiService $api, \App\Services\PredictionService $engine)
    {
        $leagueId = $request->query('league_id', 39); 
        $standings = $api->getStandings($leagueId) ?? [];
        
        $featuredMatches = \App\Models\Fixture::with(['homeTeam', 'awayTeam'])->whereDate('match_at', \Carbon\Carbon::today())->take(2)->get();

        view()->share('standings', $standings);
        view()->share('featuredMatches', $featuredMatches);

        $fixtures = \App\Models\Fixture::with(['homeTeam', 'awayTeam'])->whereDate('match_at', \Carbon\Carbon::today())->get();

        // RUN THE MATH ENGINE FOR EVERY MATCH
        foreach ($fixtures as $fixture) {
            // Generate unique baseline stats based on team names for unique math outputs
            $homePower = (crc32($fixture->homeTeam->name ?? 'Home') % 15) + 10; // Generates a number between 1.0 and 2.4
            $awayPower = (crc32($fixture->awayTeam->name ?? 'Away') % 15) + 10;

            $homeStats = ['avg_scored' => $homePower / 10, 'avg_conceded' => $awayPower / 10];
            $awayStats = ['avg_scored' => $awayPower / 10, 'avg_conceded' => $homePower / 10];

            // Inject the calculated object directly into the fixture
            $fixture->prediction = $engine->calculatePrediction($homeStats, $awayStats, 2.5);
        }

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