<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LivescoreController extends Controller
{
    public function index()
    {
        // Fetch today's fixtures with team and score data
        $fixtures = Fixture::with(['homeTeam', 'awayTeam', 'prediction'])
            ->whereDate('match_at', Carbon::today())
            ->orderBy('match_at', 'asc')
            ->get();

        return view('features.livescores', compact('fixtures'));
    }
}