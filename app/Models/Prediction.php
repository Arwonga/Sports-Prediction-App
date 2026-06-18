<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'fixture_id',
        'prob_over_2_5',
        'prob_under_2_5',
        'prob_btts_yes',
        'prob_btts_no',
    ];

    /**
     * Get the fixture associated with this prediction.
     */
    public function fixture(): BelongsTo
    {
        return $this->belongsTo(Fixture::class);
    }
}