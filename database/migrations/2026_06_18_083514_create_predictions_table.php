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
            $table->foreignId('fixture_id')->constrained()->cascadeOnDelete();
            
            // 1X2 Probabilities (Excluding Draw per strategy)
            $table->integer('home_win_prob');
            $table->integer('away_win_prob');
            
            // Goals & BTTS
            $table->integer('btts_yes_prob');
            $table->integer('btts_no_prob');
            $table->integer('over_25_prob');
            $table->integer('under_25_prob');
            
            // xG Data
            $table->decimal('home_xg', 5, 2);
            $table->decimal('away_xg', 5, 2);
            
            // Matrix & Analytics
            $table->json('top_scores');
            $table->string('verdict');
            $table->integer('confidence');
            $table->string('risk')->default('LOW');
            $table->string('value')->default('HIGH');
            
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