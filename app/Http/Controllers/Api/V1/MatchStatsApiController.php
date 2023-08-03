<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StatisticsApi\ListMatchStatsRequest;
use App\Http\Resources\V1\StatisticsApi\ListMatchStatsResource;
use App\Http\Resources\V1\StatisticsApi\ListStatsTypeResource;
use App\Repository\V1\MatchStatsRepository;
use ArrayAccess;

class MatchStatsApiController extends Controller
{
    protected MatchStatsRepository $matchStatsRepository;
    public function __construct(MatchStatsRepository $matchStatsRepository)
    {
        $this->matchStatsRepository = $matchStatsRepository;
    }

    /**
     * @param ListMatchStatsRequest $request
     * @return ArrayAccess<string,mixed> Eloquent Resources Collection
     */
    public function list(ListMatchStatsRequest $request): ArrayAccess
    {
        $filters = $request->validated();
        $paramId = $filters['param_id'] ?? null;
        $perPage = $filters['length'] ?? 25;

        $matchStats = $this->matchStatsRepository->getMatchStats($filters['year'], $paramId, $perPage);

        return ListMatchStatsResource::collection($matchStats);
    }

    /**
     * @return ArrayAccess<string,mixed> Eloquent Resources Collection
     */
    public function listStatsType(): ArrayAccess
    {
        $statsType = $this->matchStatsRepository->getStatsType();
        return ListStatsTypeResource::collection($statsType);
    }
}
