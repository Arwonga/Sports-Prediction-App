<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fixture;
use App\Models\Prediction;
use App\Services\PredictionService;
use Carbon\Carbon;

class CalculatePredictions extends Command
{
    protected $signature = 'sports:calculate-predictions {date?}';
    protected $description = 'Run the quantitative engine for a specific date (YYYY-MM-DD)';

    public function handle(PredictionService $engine)
    {
        $date = $this->argument('date') ?? Carbon::today()->format('Y-m-d');
        
        $this->info("Starting quantitative analysis for matches on: {$date}");

        $fixtures = Fixture::with(['homeTeam', 'awayTeam'])
            ->whereDate('match_at', $date)
            ->get();

        if ($fixtures->isEmpty()) {
            $this->warn("No fixtures found for {$date}. Run your API sync first.");
            return;
        }

        $bar = $this->output->createProgressBar(count($fixtures));
        $bar->start();

        foreach ($fixtures as $fixture) {
            // In a production environment, you would query your team_stats table here.
            // For now, we simulate the baseline stats as you integrate the API endpoints.
            $homePower = (crc32($fixture->homeTeam->name ?? 'Home') % 15) + 10;
            $awayPower = (crc32($fixture->awayTeam->name ?? 'Away') % 15) + 10;

            $homeStats = ['avg_scored' => $homePower / 10, 'avg_conceded' => $awayPower / 10];
            $awayStats = ['avg_scored' => $awayPower / 10, 'avg_conceded' => $homePower / 10];

            $output = $engine->calculatePrediction($homeStats, $awayStats, 2.5);

            Prediction::updateOrCreate(
                ['fixture_id' => $fixture->id],
                [
                    'home_win_prob' => $output->home_win_prob,
                    'away_win_prob' => $output->away_win_prob,
                    'btts_yes_prob' => $output->btts_yes_prob,
                    'btts_no_prob' => $output->btts_no_prob,
                    'over_25_prob' => $output->over_25_prob,
                    'under_25_prob' => $output->under_25_prob,
                    'home_xg' => $output->home_xg,
                    'away_xg' => $output->away_xg,
                    'top_scores' => $output->top_scores,
                    'verdict' => $output->verdict,
                    'confidence' => $output->confidence,
                    'risk' => $output->risk,
                    'value' => $output->value,
                ]
            );

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Analysis complete. Predictions saved to database successfully.");
    }
}