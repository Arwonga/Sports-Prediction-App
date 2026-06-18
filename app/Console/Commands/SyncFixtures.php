<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SportsApiService;
use App\Models\Team;
use App\Models\Fixture;
use Carbon\Carbon;

/**
 * Command to manually or automatically sync sports fixtures and teams from the API.
 * Author: Alex James Arwonga
 */
class SyncFixtures extends Command
{
    /**
     * The name and signature of the console command.
     * Format: php artisan sports:sync-fixtures {date?} (YYYY-MM-DD)
     */
    protected $signature = 'sports:sync-fixtures {date?}';

    /**
     * The console command description.
     */
    protected $description = 'Fetch and sync fixtures along with their teams from the external Sports API for a given date';

    /**
     * Execute the console command.
     */
    public function handle(SportsApiService $apiService): int
    {
        // Default to today if no date parameter is passed
        $date = $this->argument('date') ?? Carbon::today()->toDateString();
        
        $this->info("Starting sync for date: {$date}...");

        $fixturesData = $apiService->getFixturesByDate($date);

        if (empty($fixturesData)) {
            $this->error("No data retrieved or API request failed for {$date}.");
            return Command::FAILURE;
        }

        $this->info("Processing " . count($fixturesData) . " fixtures...");

        foreach ($fixturesData as $item) {
            $fixtureInfo = $item['fixture'] ?? [];
            $teamsInfo = $item['teams'] ?? [];
            $goalsInfo = $item['goals'] ?? [];

            if (empty($fixtureInfo) || empty($teamsInfo)) {
                continue;
            }

            // 1. Sync Home Team
            $homeTeam = Team::updateOrCreate(
                ['api_team_id' => $teamsInfo['home']['id']],
                [
                    'name' => $teamsInfo['home']['name'],
                    'logo_url' => $teamsInfo['home']['logo'] ?? null,
                ]
            );

            // 2. Sync Away Team
            $awayTeam = Team::updateOrCreate(
                ['api_team_id' => $teamsInfo['away']['id']],
                [
                    'name' => $teamsInfo['away']['name'],
                    'logo_url' => $teamsInfo['away']['logo'] ?? null,
                ]
            );

            // 3. Sync Fixture
            Fixture::updateOrCreate(
                ['api_fixture_id' => $fixtureInfo['id']],
                [
                    'home_team_id' => $homeTeam->id,
                    'away_team_id' => $awayTeam->id,
                    'match_at' => Carbon::parse($fixtureInfo['date']),
                    'status' => $fixtureInfo['status']['short'] ?? 'NS',
                    'home_score' => $goalsInfo['home'] ?? null,
                    'away_score' => $goalsInfo['away'] ?? null,
                ]
            );
        }

        $this->info("Sync completed successfully for {$date}!");
        return Command::SUCCESS;
    }
}