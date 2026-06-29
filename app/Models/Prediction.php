<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prediction extends Model
{
    protected $fillable = [
        'fixture_id', 'home_win_prob', 'away_win_prob', 'btts_yes_prob', 'btts_no_prob',
        'over_25_prob', 'under_25_prob', 'home_xg', 'away_xg', 'top_scores', 
        'verdict', 'confidence', 'risk', 'value'
    ];

    protected $casts = [
        'top_scores' => 'array',
    ];

    /**
     * Get the fixture associated with this prediction.
     */
    public function fixture(): BelongsTo
    {
        return $this->belongsTo(Fixture::class);
    }
}