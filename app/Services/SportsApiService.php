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
        return Http::withHeaders([
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

        if ($response->failed()) {
            Log::error("Failed to fetch fixtures for date: {$date}");
            return null;
        }

        return $response->json('response');
    }
}