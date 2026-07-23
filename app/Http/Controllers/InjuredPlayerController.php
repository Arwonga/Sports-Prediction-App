<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class InjuredPlayerController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->query('search');
        $apiKey = env('SPORTS_API_KEY');
        $apiUrl = env('SPORTS_API_URL', 'https://v3.football.api-sports.io');
        
        $headers = [
            'x-rapidapi-host' => 'v3.football.api-sports.io',
            'x-rapidapi-key' => $apiKey
        ];

        // ==========================================
        // 1. SEARCH MODE
        // ==========================================
        if ($searchTerm) {
            $apiInjuries = [];
            $currentSeason = date('Y');

            try {
                $teamResponse = Http::withoutVerifying()->withHeaders($headers)->get("{$apiUrl}/teams", ['search' => $searchTerm]);
                $teamId = $teamResponse->json('response.0.team.id');

                if ($teamId) {
                    $injuriesResponse = Http::withoutVerifying()->withHeaders($headers)->get("{$apiUrl}/injuries", [
                        'team' => $teamId,
                        'season' => $currentSeason
                    ]);
                    $apiInjuries = is_array($injuriesResponse->json('response')) ? $injuriesResponse->json('response') : [];
                } else {
                    $playerResponse = Http::withoutVerifying()->withHeaders($headers)->get("{$apiUrl}/players", ['search' => $searchTerm]);
                    $playerId = $playerResponse->json('response.0.player.id');

                    if ($playerId) {
                        $injuriesResponse = Http::withoutVerifying()->withHeaders($headers)->get("{$apiUrl}/injuries", [
                            'player' => $playerId,
                            'season' => $currentSeason
                        ]);
                        $apiInjuries = is_array($injuriesResponse->json('response')) ? $injuriesResponse->json('response') : [];
                    }
                }
            } catch (\Exception $e) {
                $apiInjuries = [];
            }

            $injuries = $this->formatInjuryData($apiInjuries);
            return view('features.injured-players', compact('injuries', 'searchTerm'));
        }

        // ==========================================
        // 2. FEATURED SQUADS (Hunter Loop for exactly 4 teams)
        // ==========================================
        // We cache this for 2 hours so you don't burn through your free API limits while refreshing
        $featuredTeamsData = Cache::remember('featured_squads_real_v1', 7200, function () use ($headers, $apiUrl) {
            
            // A massive pool of elite clubs to ensure we find injuries even in the off-season
            $eliteTeamIds = [
                40, 42, 47, 49, 50, 33, 34, 39, 41, 48, 66, // Premier League
                541, 529, 530, 536, // La Liga
                157, 165, 173, // Bundesliga
                496, 489, 505, 492, // Serie A
                85, 79 // Ligue 1
            ];
            
            // Shuffle them so it's different every time the cache clears
            shuffle($eliteTeamIds); 
            
            $currentSeason = date('Y');
            $teamReports = [];

            // The Hunter Loop: Keep checking teams until we have exactly 4 valid ones
            foreach ($eliteTeamIds as $teamId) {
                if (count($teamReports) >= 4) {
                    break; // Stop immediately once we have 4 teams!
                }

                try {
                    $response = Http::withoutVerifying()->withHeaders($headers)->get("{$apiUrl}/injuries", [
                        'team' => $teamId,
                        'season' => $currentSeason
                    ]);

                    if ($response->successful()) {
                        $responseData = $response->json('response');
                        $apiInjuries = is_array($responseData) ? $responseData : [];

                        $formattedInjuries = collect($this->formatInjuryData($apiInjuries))->take(5)->all();

                        // Only add to our reports if the team actually has players missing
                        if (!empty($formattedInjuries)) {
                            $teamReports[] = (object)[
                                'team_name' => $formattedInjuries[0]->team_name,
                                'team_logo' => $formattedInjuries[0]->team_logo,
                                'players' => $formattedInjuries
                            ];
                        }
                    }
                } catch (\Exception $e) {
                    continue; 
                }
            }

            // Failsafe: If the API is completely dead or rate-limited, inject the 4-team fallback
            if (count($teamReports) < 4) {
                $teamReports = $this->getFallbackData();
            }

            return collect($teamReports);
        });

        return view('features.injured-players', [
            'searchTerm' => null,
            'featuredReports' => $featuredTeamsData
        ]);
    }

    private function formatInjuryData($apiInjuries)
    {
        return collect($apiInjuries)
            ->unique('player.id')
            ->map(function ($item) {
                $rawReason = strtolower($item['player']['reason'] ?? $item['player']['type'] ?? '');
                
                $status = 'OUT';
                if (str_contains($rawReason, 'suspend') || str_contains($rawReason, 'red card')) {
                    $status = 'SUSPENDED';
                } elseif (str_contains($rawReason, 'doubt') || str_contains($rawReason, 'knock')) {
                    $status = 'DOUBTFUL';
                }

                $missingFixtureDate = isset($item['fixture']['date']) 
                    ? Carbon::parse($item['fixture']['date'])->format('Y-m-d') 
                    : 'Unknown';

                return (object)[
                    'player_name' => $item['player']['name'] ?? 'Unknown',
                    'team_name' => $item['team']['name'] ?? 'Unknown Team',
                    'team_logo' => $item['team']['logo'] ?? '',
                    'type' => $item['player']['reason'] ?? $item['player']['type'] ?? 'Reported Absent',
                    'status' => $status, 
                    'return_date' => $missingFixtureDate,
                ];
            })->values()->all();
    }

    private function getFallbackData()
    {
        // Upgraded Fallback data guaranteeing 4 complete teams
        return [
            (object)[
                'team_name' => 'Real Madrid',
                'team_logo' => 'https://media.api-sports.io/football/teams/541.png',
                'players' => [
                    (object)['player_name' => 'T. Courtois', 'type' => 'ACL Injury', 'status' => 'OUT', 'return_date' => '2026-08-15'],
                    (object)['player_name' => 'E. Militão', 'type' => 'Muscle Fatigue', 'status' => 'DOUBTFUL', 'return_date' => 'Unknown'],
                    (object)['player_name' => 'A. Tchouaméni', 'type' => 'Red Card', 'status' => 'SUSPENDED', 'return_date' => '2026-07-28'],
                ]
            ],
            (object)[
                'team_name' => 'Manchester City',
                'team_logo' => 'https://media.api-sports.io/football/teams/50.png',
                'players' => [
                    (object)['player_name' => 'K. De Bruyne', 'type' => 'Hamstring', 'status' => 'OUT', 'return_date' => '2026-09-01'],
                    (object)['player_name' => 'J. Stones', 'type' => 'Ankle Knock', 'status' => 'DOUBTFUL', 'return_date' => 'Unknown'],
                ]
            ],
            (object)[
                'team_name' => 'Arsenal',
                'team_logo' => 'https://media.api-sports.io/football/teams/42.png',
                'players' => [
                    (object)['player_name' => 'B. Saka', 'type' => 'Thigh Muscle Strain', 'status' => 'DOUBTFUL', 'return_date' => '2026-08-05'],
                    (object)['player_name' => 'J. Timber', 'type' => 'Knee Injury', 'status' => 'OUT', 'return_date' => 'Unknown'],
                ]
            ],
            (object)[
                'team_name' => 'Bayern Munich',
                'team_logo' => 'https://media.api-sports.io/football/teams/157.png',
                'players' => [
                    (object)['player_name' => 'S. Gnabry', 'type' => 'Groin Strain', 'status' => 'OUT', 'return_date' => '2026-08-10'],
                    (object)['player_name' => 'D. Upamecano', 'type' => 'Yellow Cards', 'status' => 'SUSPENDED', 'return_date' => '2026-07-30'],
                ]
            ]
        ];
    }
}