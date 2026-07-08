<?php

namespace App\Services;

class PredictionAlgorithmService
{
    /**
     * Core Mathematical Function: Calculate the factorial of a number.
     * Required for the denominator of the Poisson equation.
     */
    private function factorial($n)
    {
        return $n <= 1 ? 1 : $n * $this->factorial($n - 1);
    }

    /**
     * Core Mathematical Function: The Poisson Equation.
     * Calculates the probability of scoring exactly $k goals given an expected average of $lambda.
     */
    private function poissonProbability($k, $lambda)
    {
        return (pow($lambda, $k) * exp(-$lambda)) / $this->factorial($k);
    }

    /**
     * MODULE 1: The Poisson Matrix Generator
     * Takes the Expected Goals (xG) for Home and Away, and returns a fully calculated probability matrix.
     */
    public function calculatePoissonMatrix($homeXG, $awayXG)
    {
        $maxGoals = 5; // We calculate up to 5 goals. Anything beyond is statistically negligible.
        $homeGoalProbs = [];
        $awayGoalProbs = [];

        // 1. Calculate the probability of scoring 0, 1, 2, 3, 4, and 5 goals for each team
        for ($i = 0; $i <= $maxGoals; $i++) {
            $homeGoalProbs[$i] = $this->poissonProbability($i, $homeXG);
            $awayGoalProbs[$i] = $this->poissonProbability($i, $awayXG);
        }

        // Initialize our final tracking variables
        $homeWinProb = 0;
        $drawProb = 0;
        $awayWinProb = 0;
        $over25Prob = 0;
        $bttsYesProb = 0;

        // 2. The Matrix Multiplication Loop
        // We cross-reference every possible scoreline (e.g., Home scores 2, Away scores 1)
        for ($homeGoals = 0; $homeGoals <= $maxGoals; $homeGoals++) {
            for ($awayGoals = 0; $awayGoals <= $maxGoals; $awayGoals++) {
                
                // The probability of this exact scoreline occurring
                $scoreProbability = $homeGoalProbs[$homeGoals] * $awayGoalProbs[$awayGoals];

                // Add to 1X2 Markets
                if ($homeGoals > $awayGoals) {
                    $homeWinProb += $scoreProbability;
                } elseif ($homeGoals === $awayGoals) {
                    $drawProb += $scoreProbability;
                } else {
                    $awayWinProb += $scoreProbability;
                }

                // Add to Over/Under 2.5 Market
                if (($homeGoals + $awayGoals) > 2) {
                    $over25Prob += $scoreProbability;
                }

                // Add to Both Teams to Score (BTTS) Market
                if ($homeGoals > 0 && $awayGoals > 0) {
                    $bttsYesProb += $scoreProbability;
                }
            }
        }

        // Return the clean, calculated percentages ready for your database
        return [
            'home_win' => round($homeWinProb * 100, 2),
            'draw'     => round($drawProb * 100, 2),
            'away_win' => round($awayWinProb * 100, 2),
            'over_25'  => round($over25Prob * 100, 2),
            'under_25' => round((1 - $over25Prob) * 100, 2),
            'btts_yes' => round($bttsYesProb * 100, 2),
            'btts_no'  => round((1 - $bttsYesProb) * 100, 2),
        ];
    }

    /**
     * MODULE 2: The xG (Expected Goals) Calculator
     * Analyzes recent form to determine how many goals a team is likely to score.
     */
    public function calculateExpectedGoals($homeTeamId, $awayTeamId)
    {
        // 1. Analyze Home Team's form AT HOME (last 10 games)
        $homeMatches = \App\Models\Fixture::where('home_team_id', $homeTeamId)
            ->whereNotNull('home_score')
            ->orderBy('match_at', 'desc')
            ->take(10)
            ->get();

        // If they have no history yet, default to a league average of 1.0 to prevent math errors
        $homeScoredAvg = $homeMatches->avg('home_score') ?? 1.0; 
        $homeConcededAvg = $homeMatches->avg('away_score') ?? 1.0;

        // 2. Analyze Away Team's form AWAY FROM HOME (last 10 games)
        $awayMatches = \App\Models\Fixture::where('away_team_id', $awayTeamId)
            ->whereNotNull('home_score') // Ensure the match actually finished
            ->orderBy('match_at', 'desc')
            ->take(10)
            ->get();

        $awayScoredAvg = $awayMatches->avg('away_score') ?? 1.0;
        $awayConcededAvg = $awayMatches->avg('home_score') ?? 1.0;

        // 3. The Blend: Calculating Lambda (Expected Goals)
        // Home xG = (Home's attacking strength + Away's defensive vulnerability) / 2
        $homeXG = ($homeScoredAvg + $awayConcededAvg) / 2;
        
        // Away xG = (Away's attacking strength + Home's defensive vulnerability) / 2
        $awayXG = ($awayScoredAvg + $homeConcededAvg) / 2;

        return [
            'home_xg' => round($homeXG, 3), // e.g., 1.845
            'away_xg' => round($awayXG, 3)  // e.g., 0.920
        ];
    }
}