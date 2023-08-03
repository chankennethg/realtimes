<?php

namespace App\Repository\V1;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MatchStatsRepository
{
    /**
     * @param int $year
     * @param int|null $paramId
     * @param int $perPage
     * @return LengthAwarePaginator<object>
     */
    public function getMatchStats(
        int $year,
        ?int $paramId = null,
        int $perPage = 25,
    ): LengthAwarePaginator
    {
        $query = DB::table('match_stats as ms')
            ->join('matches as m', 'ms.match_id', '=', 'm.id')
            ->join('players as p', 'ms.player_id', '=', 'p.id')
            ->select(
                'ms.player_id',
                'p.firstname',
                'p.lastname',
                'p.football_name',
                'ms.param_name',
                'm.match_year',
                DB::raw('SUM(ms.value) as total_value')
            )
            ->where('m.match_year', $year)
            ->groupBy('m.match_year', 'ms.player_id', 'ms.param_name',)
            ->orderByDesc('total_value');

        // If param_id is set, add a where clause for it
        if ($paramId) {
            $query->where('ms.param_id', $paramId);
        }

        return $query->paginate($perPage);
    }

    /**
     * @return Collection<int,string>
     */
    public function getStatsType(): Collection
    {
        return DB::table('match_stats')
            ->select('param_id', 'param_name')
            ->groupBy('param_id', 'param_name')
            ->orderBy('param_name')
            ->get();
    }
}
