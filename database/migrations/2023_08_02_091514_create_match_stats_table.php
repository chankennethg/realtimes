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
        Schema::create('match_stats', function (Blueprint $table) {
            $table->unsignedBigInteger('match_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('player_id');
            $table->integer('param_id');
            $table->string('param_name');
            $table->decimal('value', 5, 2);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();

            // Foreign Keys
            $table->foreign('match_id')->references('id')->on('matches')->restrictOnDelete();
            $table->foreign('team_id')->references('id')->on('teams')->restrictOnDelete();
            $table->foreign('player_id')->references('id')->on('players')->restrictOnDelete();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_stats');
    }
};
