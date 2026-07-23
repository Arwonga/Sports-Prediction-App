<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;
use Carbon\Carbon;

class TeamComparisonController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $searchResults = [];
        $fixture = null;

        // ==========================================
        // 1. SEARCH MODE: Find matches for a specific team
        // ==========================================
        if ($search) {
            $searchResults = Fixture::with(['homeTeam', 'awayTeam', 'prediction'])
                ->whereHas('homeTeam', function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('awayTeam', function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orderBy('match_at', 'desc')
                ->take(12) // Limit to 12 results for a clean UI grid
                ->get();
        } 
        // ==========================================
        // 2. DEFAULT MODE: Today's top match
        // ==========================================
        else {
            $fixture = Fixture::with(['homeTeam', 'awayTeam', 'prediction'])
                ->whereDate('match_at', Carbon::today())
                ->join('predictions', 'fixtures.id', '=', 'predictions.fixture_id')
                ->orderBy('predictions.confidence', 'desc')
                ->select('fixtures.*')
                ->first();

            // Failsafe if no games are scheduled today. 
            // Explicitly using logo_url to match your database structure perfectly.
            if (!$fixture) {
                $fixture = (object)[
                    'homeTeam' => (object)['name' => 'Real Madrid', 'logo_url' => 'https://media.api-sports.io/football/teams/541.png'],
                    'awayTeam' => (object)['name' => 'Barcelona', 'logo_url' => 'https://media.api-sports.io/football/teams/529.png'],
                    'match_at' => Carbon::today()->format('Y-m-d H:i:s'),
                    'prediction' => (object)['home_xg' => 2.1, 'away_xg' => 1.8, 'confidence' => 85]
                ];
            }
        }

        // Mock statistical data for the UI layout (To be wired to live DB/API later)
        $stats = [
            'win_probability' => ['home' => 45, 'away' => 30, 'draw' => 25],
            'avg_goals_scored' => ['home' => 2.1, 'away' => 1.8],
            'avg_goals_conceded' => ['home' => 0.9, 'away' => 1.2],
            'clean_sheets' => ['home' => '40%', 'away' => '25%'],
            'possession' => ['home' => '58%', 'away' => '52%'],
            'home_form' => ['W', 'W', 'D', 'W', 'L'],
            'away_form' => ['D', 'L', 'W', 'D', 'W'],
        ];

        return view('features.team-comparison', compact('fixture', 'stats', 'search', 'searchResults'));
    }
}