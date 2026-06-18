<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fixture;
use App\Models\Prediction;
use App\Services\PredictionService;
use Carbon\Carbon;

/**
 * Command to calculate and save statistical predictions.
 */
class CalculatePredictions extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'sports:calculate-predictions';

    /**
     * The console command description.
     */
    protected $description = 'Calculate and store alternative market predictions for upcoming matches';

    /**
     * Execute the console command.
     */
    public function handle(PredictionService $predictionService): int
    {
        $this->info('Starting prediction calculations...');

        // Fetch fixtures happening from today onwards that haven't started yet
        $upcomingFixtures = Fixture::where('match_at', '>=', Carbon::today())
            ->where('status', 'NS')
            ->get();

        if ($upcomingFixtures->isEmpty()) {
            $this->warn('No upcoming fixtures found to predict.');
            return Command::SUCCESS;
        }

        $bar = $this->output->createProgressBar(count($upcomingFixtures));
        $bar->start();

        foreach ($upcomingFixtures as $fixture) {
            // In a production environment, you would calculate these dynamically based on the last 10 games.
            // For now, we establish the pipeline with realistic placeholder data.
            $homeXg = 1.65; // Example Expected Goals
            $awayXg = 1.20; 

            // Pass the xG into our Poisson math service
            $probabilities = $predictionService->calculateMarketProbabilities($homeXg, $awayXg);

            // Save the exact percentages directly into the predictions table
            Prediction::updateOrCreate(
                ['fixture_id' => $fixture->id],
                [
                    'prob_over_2_5' => $probabilities['prob_over_2_5'],
                    'prob_under_2_5' => $probabilities['prob_under_2_5'],
                    'prob_btts_yes' => $probabilities['prob_btts_yes'],
                    'prob_btts_no' => $probabilities['prob_btts_no'],
                ]
            );

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Predictions successfully calculated and saved to the database!');

        return Command::SUCCESS;
    }
}