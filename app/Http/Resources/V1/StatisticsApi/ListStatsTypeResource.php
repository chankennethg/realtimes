<?php

namespace App\Http\Resources\V1\StatisticsApi;

use App\Models\MatchStat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin MatchStat
 */
class ListStatsTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'param_id' => $this->param_id,
            'param_name' => $this->param_name,
        ];
    }
}
