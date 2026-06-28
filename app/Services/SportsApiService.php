<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service to handle data ingestion from external sports APIs.
 * Author: Alex James Arwonga
 */
class SportsApiService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.sports.url');
        $this->apiKey = config('services.sports.key');
    }

    /**
     * Build the base HTTP client with the required authentication headers.
     */
    protected function client()
    {
        return Http::withoutVerifying()->withHeaders([
            'x-apisports-key' => $this->apiKey,
            'Accept' => 'application/json',
        ])->baseUrl($this->baseUrl);
    }
    /**
     * Fetch upcoming fixtures for a specific date.
     */
    public function getFixturesByDate(string $date)
    {
        $response = $this->client()->get('/fixtures', [
            'date' => $date,
        ]);

        // Check if API-Football returned a 200 OK but included API errors (like rate limits)
        if (!empty($response->json('errors'))) {
            \Illuminate\Support\Facades\Log::error("API Error: ", $response->json('errors'));
            dd($response->json('errors')); // This will dump the exact error in your terminal
        }

        if ($response->failed()) {
            \Illuminate\Support\Facades\Log::error("Failed to fetch fixtures for date: {$date}");
            return null;
        }

        return $response->json('response');
    }
}