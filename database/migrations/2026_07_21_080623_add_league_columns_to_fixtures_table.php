<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('fixtures', function (Blueprint $table) {
        $table->unsignedBigInteger('league_id')->nullable()->after('away_team_id');
        $table->string('league_name')->nullable()->after('league_id');
    });
}

public function down(): void
{
    Schema::table('fixtures', function (Blueprint $table) {
        $table->dropColumn(['league_id', 'league_name']);
    });
}
};
