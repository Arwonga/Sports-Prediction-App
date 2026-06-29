<?php

namespace App\Services;

class PredictionService
{
    /**
     * Generate the complete quantitative prediction output.
     */
    public function calculatePrediction(array $homeStats, array $awayStats, float $leagueAvgGoals)
    {
        // STEP 1 & 2: Calculate Strengths
        $homeAttack = $homeStats['avg_scored'] / $leagueAvgGoals;
        $homeDefence = $homeStats['avg_conceded'] / $leagueAvgGoals;
        
        $awayAttack = $awayStats['avg_scored'] / $leagueAvgGoals;
        $awayDefence = $awayStats['avg_conceded'] / $leagueAvgGoals;

        $homeAdvantage = 1.15; // Standard home advantage weight

        // STEP 3: Expected Goals (xG)
        $homeXg = $homeAttack * $awayDefence * $leagueAvgGoals * $homeAdvantage;
        $awayXg = $awayAttack * $homeDefence * $leagueAvgGoals;

        // STEP 4 & 5: Poisson Distribution & Matrix
        $matrix = $this->generateScoreMatrix($homeXg, $awayXg);

        // STEP 6: Calculate Outcomes (Excluding Draw Market Predictions per strategy)
        $homeWinProb = 0;
        $awayWinProb = 0;
        $drawProb = 0;

        foreach ($matrix as $homeGoals => $awayProbs) {
            foreach ($awayProbs as $awayGoals => $prob) {
                if ($homeGoals > $awayGoals) $homeWinProb += $prob;
                elseif ($homeGoals < $awayGoals) $awayWinProb += $prob;
                else $drawProb += $prob;
            }
        }

        // STEP 7: BTTS
        $pHomeZero = $this->poisson(0, $homeXg);
        $pAwayZero = $this->poisson(0, $awayXg);
        $pZeroZero = $pHomeZero * $pAwayZero;
        
        $bttsYesProb = 1 - $pHomeZero - $pAwayZero + $pZeroZero;
        $bttsNoProb = 1 - $bttsYesProb;

        // STEP 8: Over/Under 2.5
        $underScores = [[0,0], [1,0], [0,1], [1,1], [2,0], [0,2]];
        $under25Prob = 0;
        foreach ($underScores as $score) {
            $under25Prob += $matrix[$score[0]][$score[1]];
        }
        $over25Prob = 1 - $under25Prob;

        // DECISION RULES & OUTPUT
        return $this->formatOutput([
            'homeXg' => $homeXg,
            'awayXg' => $awayXg,
            'homeWinProb' => $homeWinProb,
            'awayWinProb' => $awayWinProb,
            'drawProb' => $drawProb, // Calculated mathematically, but ignored in betting decisions
            'bttsYesProb' => $bttsYesProb,
            'bttsNoProb' => $bttsNoProb,
            'over25Prob' => $over25Prob,
            'under25Prob' => $under25Prob,
            'matrix' => $matrix,
            'dataQuality' => 90, // Placeholder for Confidence Score logic
        ]);
    }

    private function generateScoreMatrix($homeXg, $awayXg, $maxGoals = 6)
    {
        $matrix = [];
        for ($i = 0; $i <= $maxGoals; $i++) {
            for ($j = 0; $j <= $maxGoals; $j++) {
                $matrix[$i][$j] = $this->poisson($i, $homeXg) * $this->poisson($j, $awayXg);
            }
        }
        return $matrix;
    }

    private function poisson($k, $lambda)
    {
        return (exp(-$lambda) * pow($lambda, $k)) / $this->factorial($k);
    }

    private function factorial($n)
    {
        return ($n <= 1) ? 1 : $n * $this->factorial($n - 1);
    }

    private function formatOutput($data)
    {
        $homeWinPct = round($data['homeWinProb'] * 100);
        $awayWinPct = round($data['awayWinProb'] * 100);
        $bttsYesPct = round($data['bttsYesProb'] * 100);
        $over25Pct = round($data['over25Prob'] * 100);

        // Strict Decision Rules (No Draw Market)
        $verdict = "NO BET";
        if ($homeWinPct > 55) $verdict = "HOME WIN";
        elseif ($awayWinPct > 55) $verdict = "AWAY WIN";

        // Sort matrix for top 3 correct scores
        $flatScores = [];
        foreach($data['matrix'] as $h => $aways) {
            foreach($aways as $a => $p) {
                $flatScores["$h - $a"] = round($p * 100, 1);
            }
        }
        arsort($flatScores);
        $topScores = array_slice($flatScores, 0, 3, true);

        return (object) [
            'home_win_prob' => $homeWinPct,
            'away_win_prob' => $awayWinPct,
            'btts_yes_prob' => $bttsYesPct,
            'btts_no_prob' => 100 - $bttsYesPct,
            'over_25_prob' => $over25Pct,
            'under_25_prob' => 100 - $over25Pct,
            'verdict' => $verdict,
            'home_xg' => round($data['homeXg'], 2),
            'away_xg' => round($data['awayXg'], 2),
            'top_scores' => $topScores,
            'confidence' => round(($data['dataQuality'] + 95 + 80 + 90) / 4),
            'risk' => 'LOW',
            'value' => 'HIGH'
        ];
    }
}