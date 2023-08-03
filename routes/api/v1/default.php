<?php

use App\Http\Controllers\Api\V1\MatchStatsApiController;
use Illuminate\Support\Facades\Route;

/**
 * ----------------------------------------
 * Default public routes
 * ----------------------------------------
 */

Route::get('/match-stats', [MatchStatsApiController::class, 'list']);
Route::get('/stats-type', [MatchStatsApiController::class, 'listStatsType']);
