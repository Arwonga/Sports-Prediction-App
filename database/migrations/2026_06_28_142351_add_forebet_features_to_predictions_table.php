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
        Schema::table('predictions', function (Blueprint $table) {
            $table->string('correct_score')->nullable()->after('prob_btts_no');
            $table->decimal('avg_goals', 4, 2)->nullable()->after('correct_score');
            $table->string('weather_conditions')->nullable()->after('avg_goals');
            $table->decimal('bookmaker_odds', 4, 2)->nullable()->after('weather_conditions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('predictions', function (Blueprint $table) {
            $table->dropColumn([
                'correct_score', 
                'avg_goals', 
                'weather_conditions', 
                'bookmaker_odds'
            ]);
        });
    }
};