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
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            
            // Link directly to the match
            $table->foreignId('fixture_id')->unique()->constrained('fixtures')->onDelete('cascade');
            
            // Alternative Market Statistical Probabilities (Stored as percentages, e.g., 68.50)
            $table->decimal('prob_over_2_5', 5, 2)->comment('Probability of Over 2.5 Goals');
            $table->decimal('prob_under_2_5', 5, 2)->comment('Probability of Under 2.5 Goals');
            $table->decimal('prob_btts_yes', 5, 2)->comment('Probability of Both Teams to Score (Yes)');
            $table->decimal('prob_btts_no', 5, 2)->comment('Probability of Both Teams to Score (No)');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};