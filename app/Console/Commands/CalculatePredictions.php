<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fixture;
use App\Models\Prediction;
use App\Services\PredictionAlgorithmService;
use Carbon\Carbon;

class CalculatePredictions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sports:calculate-predictions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the modular ensemble mathematical models to calculate percentages for upcoming matches.';

    /**
     * The instance of the prediction algorithm brain.
     */
    protected $algorithmService;

    /**
     * Inject the mathematical service class into the console command.
     */
    public function __construct(PredictionAlgorithmService $algorithmService)
    {
        parent::__construct();
        $this->algorithmService = $algorithmService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Initializing Ensemble Prediction Engine...');

        // Fetch upcoming fixtures from today onward to calculate mathematical edges
        $fixtures = Fixture::with(['homeTeam', 'awayTeam'])
            ->where('match_at', '>=', Carbon::today()->startOfDay())
            ->get();

        if ($fixtures->isEmpty()) {
            $this->warn('No upcoming fixtures found in the database to analyze.');
            return Command::SUCCESS;
        }

        $this->info("Processing math models for " . $fixtures->count() . " fixtures...");
        $this->newLine();

        foreach ($fixtures as $fixture) {
            $this->line("Analyzing: <info>{$fixture->homeTeam->name}</info> vs <info>{$fixture->awayTeam->name}</info>");

            // 1. Calculate Expected Goals (xG) using the historical form module
            $xgData = $this->algorithmService->calculateExpectedGoals(
                $fixture->home_team_id, 
                $fixture->away_team_id
            );

            // 2. Feed calculated xG parameters directly into the Poisson Matrix Generator
            $probabilities = $this->algorithmService->calculatePoissonMatrix(
                $xgData['home_xg'], 
                $xgData['away_xg']
            );

            // 3. Persist the generated probabilities to the predictions table
            Prediction::updateOrCreate(
                ['fixture_id' => $fixture->id],
                [
                    'home_win_prob' => $probabilities['home_win'],
                    'draw_prob'     => $probabilities['draw'],
                    'away_win_prob' => $probabilities['away_win'],
                    'over_25_prob'  => $probabilities['over_25'],
                    'under_25_prob' => $probabilities['under_25'],
                    'btts_yes_prob' => $probabilities['btts_yes'],
                    'btts_no_prob'  => $probabilities['btts_no'],
                    'home_xg'       => $xgData['home_xg'],
                    'away_xg'       => $xgData['away_xg'],
                    'top_scores'    => '[]',
                    'verdict'       => 'CALCULATED',
                    'confidence'    => 0,
                ]
            );
        }

        $this->newLine();
        $this->info('Ensemble matrix calculations successfully updated in database.');
        return Command::SUCCESS;
    }
}