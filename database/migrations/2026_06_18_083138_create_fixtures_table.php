<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('api_fixture_id')->unique()->comment('The unique match ID from the external API');
            
            // Foreign keys pointing to teams table
            $table->foreignId('home_team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('away_team_id')->constrained('teams')->onDelete('cascade');
            
            // Match Details
            $table->dateTime('match_at')->comment('The date and time when the match kicks off');
            $table->string('status')->default('NS')->comment('NS = Not Started, FT = Full Time, HT = Halftime, etc.');
            
            // Real-time / Final Scores (Nullable since upcoming matches won't have scores yet)
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            
            $table->timestamps();

            // Indexes for optimizing complex queries and schedule lookups
            $table->index('api_fixture_id');
            $table->index('match_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};