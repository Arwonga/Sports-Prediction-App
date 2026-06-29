<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'api_fixture_id',
        'home_team_id',
        'away_team_id',
        'match_at',
        'status',
        'home_score',
        'away_score',
        'league_id' ,
    ];

    protected $casts = [
        'match_at' => 'datetime',
    ];

    /**
     * Get the home team for this fixture.
     */
    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    /**
     * Get the away team for this fixture.
     */
    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    /**
    * Get the analytical prediction associated with this fixture.
    */
    public function prediction(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
    return $this->hasOne(Prediction::class);
    }
}