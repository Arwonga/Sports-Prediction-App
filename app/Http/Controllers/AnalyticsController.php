<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Retrieve only the predictions that have been finalized and graded
        $graded = Prediction::whereNotNull('is_correct')->get();

        // Overall Strike Rate
        $total = $graded->count();
        $won = $graded->where('is_correct', true)->count();
        $overallRate = $total > 0 ? round(($won / $total) * 100, 1) : 0;

        // Goal Markets (Over/Under, BTTS)
        $goalMarkets = $graded->whereIn('verdict', ['OVER 2.5', 'UNDER 2.5', 'BTTS YES', 'BTTS NO']);
        $goalTotal = $goalMarkets->count();
        $goalWon = $goalMarkets->where('is_correct', true)->count();
        $goalRate = $goalTotal > 0 ? round(($goalWon / $goalTotal) * 100, 1) : 0;

        // Match Outcome Markets (Home, Away, Draw)
        $resultMarkets = $graded->whereIn('verdict', ['HOME WIN', 'AWAY WIN', 'DRAW']);
        $resultTotal = $resultMarkets->count();
        $resultWon = $resultMarkets->where('is_correct', true)->count();
        $resultRate = $resultTotal > 0 ? round(($resultWon / $resultTotal) * 100, 1) : 0;

        return view('analytics.index', compact(
            'total', 'won', 'overallRate',
            'goalTotal', 'goalWon', 'goalRate',
            'resultTotal', 'resultWon', 'resultRate'
        ));
    }
}