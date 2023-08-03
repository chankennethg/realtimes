<?php

namespace App\Http\Resources\V1\StatisticsApi;

use App\Helpers\StatsFormatter;
use App\Models\MatchModel;
use App\Models\MatchStat;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MatchStat
 * @mixin Player
 * @mixin MatchModel
 * @property mixed $total_value
 */
class ListMatchStatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $playerName = $this->football_name ?? $this->firstname . ' ' . $this->lastname;
        return [
            'player_name' => $playerName,
            'param_name' => $this->param_name,
            'value' => StatsFormatter::formatStats($this->total_value),
            'year' => $this->match_year,
        ];
    }
}
