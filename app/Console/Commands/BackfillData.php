<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class BackfillData extends Command
{
    /**
     * The name and signature of the console command.
     * We default to 7 days, but you can pass any number of days.
     *
     * @var string
     */
    protected $signature = 'sports:backfill {days=7}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically fetch historical fixtures and calculate predictions for the past X days.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->argument('days');
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays($days);

        $this->info("Initializing Quantitative Backfill Engine...");
        $this->info("Target Range: {$startDate->toDateString()} to {$endDate->toDateString()}");
        $this->newLine();

        $currentDate = $startDate->copy();

        // Loop through every single day and trigger the sync command
        while ($currentDate->lte($endDate)) {
            $dateString = $currentDate->toDateString();
            $this->line("Fetching historical data for: <info>{$dateString}</info>");

            // This invisibly runs your existing sports:sync-fixtures command
            $this->call('sports:sync-fixtures', [
                'date' => $dateString
            ]);

            // Add one day to move the loop forward
            $currentDate->addDay();
            
            // Sleep for 1 second to avoid rate-limiting from your API provider
            sleep(1); 
        }

        $this->newLine();
        $this->info("All historical fixtures successfully synced to SQL Server.");
        $this->info("Spinning up the mathematical prediction engine...");
        
        // Run the calculations once everything is downloaded
        $this->call('sports:calculate-predictions');

        $this->newLine();
        $this->info("Backfill Complete. Your database is fully loaded.");
    }
}