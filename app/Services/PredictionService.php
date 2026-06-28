<?php

namespace App\Services;
use App\Models\Fixture;

class PredictionService
{
    /**
     * Calculate O/U 2.5 and BTTS probabilities based on Expected Goals (xG)
     * * @param float $homeXg The expected goals for the home team
     * @param float $awayXg The expected goals for the away team
     * @return array
     */
    public function calculateMarketProbabilities(float $homeXg, float $awayXg): array
    {
        $under25Prob = 0;
        $bttsYesProb = 0;
        
        // We calculate the probability of scoring 0 to 5 goals for both teams
        // (Scoring 6+ goals is statistically negligible for standard predictions)
        $maxGoals = 5;

        for ($homeGoals = 0; $homeGoals <= $maxGoals; $homeGoals++) {
            for ($awayGoals = 0; $awayGoals <= $maxGoals; $awayGoals++) {
                
                // Calculate the exact probability of this specific scoreline (e.g., 2-1)
                $scorelineProbability = $this->poisson($homeGoals, $homeXg) * $this->poisson($awayGoals, $awayXg);

                // Check for Under 2.5 Goals (0-0, 1-0, 0-1, 1-1, 2-0, 0-2)
                if (($homeGoals + $awayGoals) < 2.5) {
                    $under25Prob += $scorelineProbability;
                }

                // Check for Both Teams To Score (BTTS: Yes)
                if ($homeGoals > 0 && $awayGoals > 0) {
                    $bttsYesProb += $scorelineProbability;
                }
            }
        }

        // Convert decimals to percentages and round to 2 decimal places
        return [
            'prob_under_2_5' => round($under25Prob * 100, 2),
            'prob_over_2_5' => round((1 - $under25Prob) * 100, 2),
            'prob_btts_yes' => round($bttsYesProb * 100, 2),
            'prob_btts_no' => round((1 - $bttsYesProb) * 100, 2),
        ];
    }

    /**
     * The Poisson Distribution Mathematical Formula
     */
    private function poisson(int $k, float $lambda): float
    {
        return (pow($lambda, $k) * exp(-$lambda)) / $this->factorial($k);
    }

    /**
     * Helper to calculate factorial (k!)
     */
    private function factorial(int $n): int
    {
        if ($n <= 1) {
            return 1;
        }
        return $n * $this->factorial($n - 1);
    }

    /**
     * Calculate dynamic Expected Goals (xG) based on recent historical performance.
     */
    public function calculateDynamicXg(int $homeTeamId, int $awayTeamId): array
    {
        // Home Team's Attack vs Away Team's Defense
        $homeScoredAtHome = Fixture::where('home_team_id', $homeTeamId)->where('status', 'FT')->orderByDesc('match_at')->take(5)->avg('home_score') ?? 1.4;
        $awayConcededAway = Fixture::where('away_team_id', $awayTeamId)->where('status', 'FT')->orderByDesc('match_at')->take(5)->avg('home_score') ?? 1.4;

        // Away Team's Attack vs Home Team's Defense
        $awayScoredAway = Fixture::where('away_team_id', $awayTeamId)->where('status', 'FT')->orderByDesc('match_at')->take(5)->avg('away_score') ?? 1.2;
        $homeConcededAtHome = Fixture::where('home_team_id', $homeTeamId)->where('status', 'FT')->orderByDesc('match_at')->take(5)->avg('away_score') ?? 1.2;

        // Calculate final xG by averaging attack capabilities against defensive vulnerabilities
        $homeXg = ($homeScoredAtHome + $awayConcededAway) / 2;
        $awayXg = ($awayScoredAway + $homeConcededAtHome) / 2;

        // Ensure xG is never exactly 0 to prevent mathematical errors in the Poisson formula
        return [
            'home' => max($homeXg, 0.1),
            'away' => max($awayXg, 0.1)
        ];
    }
}