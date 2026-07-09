<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SportsApiService;
use App\Models\Team;
use App\Models\Fixture;
use Carbon\Carbon;

class SyncFixtures extends Command
{
    protected $signature = 'sports:sync-fixtures {date?}';
    protected $description = 'Fetch and sync fixtures along with their teams from the external Sports API for a given date';

    public function handle(SportsApiService $apiService): int
    {
        // Default strictly to today if no date is passed
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

            $homeTeam = Team::updateOrCreate(
                ['api_team_id' => $teamsInfo['home']['id']],
                ['name' => $teamsInfo['home']['name'], 'logo_url' => $teamsInfo['home']['logo'] ?? null]
            );

            $awayTeam = Team::updateOrCreate(
                ['api_team_id' => $teamsInfo['away']['id']],
                ['name' => $teamsInfo['away']['name'], 'logo_url' => $teamsInfo['away']['logo'] ?? null]
            );

            // This will create new matches OR update existing ones with the latest FT scores
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