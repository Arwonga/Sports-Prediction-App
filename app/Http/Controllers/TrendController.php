<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TrendController extends Controller
{
    public function index()
    {
        // 1. Top 3 Highest Over 2.5 Probability Trends
        $over25Trends = Fixture::with(['prediction', 'homeTeam', 'awayTeam'])
            ->whereDate('match_at', Carbon::today())
            ->whereHas('prediction', function($query) {
                $query->where('over_25_prob', '>=', 50); 
            })
            ->join('predictions', 'fixtures.id', '=', 'predictions.fixture_id')
            ->orderBy('predictions.over_25_prob', 'desc')
            ->select('fixtures.*')
            ->take(3)
            ->get();

        // 2. Top 3 Highest BTTS (Yes) Probability Trends
        $bttsTrends = Fixture::with(['prediction', 'homeTeam', 'awayTeam'])
            ->whereDate('match_at', Carbon::today())
            ->whereHas('prediction', function($query) {
                $query->where('btts_yes_prob', '>=', 50);
            })
            ->join('predictions', 'fixtures.id', '=', 'predictions.fixture_id')
            ->orderBy('predictions.btts_yes_prob', 'desc')
            ->select('fixtures.*')
            ->take(3)
            ->get();

        // 3. Top 3 Highest Home/Away Win Probability Trends
        $homeAwayTrends = Fixture::with(['prediction', 'homeTeam', 'awayTeam'])
            ->whereDate('match_at', Carbon::today())
            ->whereHas('prediction', function($query) {
                $query->where('home_win_prob', '>=', 50)->orWhere('away_win_prob', '>=', 50);
            })
            ->join('predictions', 'fixtures.id', '=', 'predictions.fixture_id')
            ->orderByRaw('GREATEST(predictions.home_win_prob, predictions.away_win_prob) DESC')
            ->select('fixtures.*')
            ->take(3)
            ->get();

        return view('features.trends', compact('over25Trends', 'bttsTrends', 'homeAwayTrends'));
    }
}