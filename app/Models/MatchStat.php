<?php

namespace App\Models;

use App\Models\Contracts\Listable as ListableContract;
use App\Models\Traits\Listable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MatchStat
 *
 * @property int $match_id
 * @property int $team_id
 * @property int $player_id
 * @property int $param_id
 * @property string $param_name
 * @property string $value
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat filterExact(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat filterLike(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat sort(string $column = 'created_at', string $direction = 'true')
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat whereMatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat whereParamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat whereParamName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat wherePlayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat whereValue($value)
 * @property-read \App\Models\MatchModel $match
 * @method static \Illuminate\Database\Eloquent\Builder|MatchStat byMatchYear($year)
 * @property-read \App\Models\Player $player
 * @property-read \App\Models\Team $team
 * @mixin \Eloquent
 */
class MatchStat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'match_id',
        'team_id',
        'player_id',
        'param_id',
        'param_name',
        'value',
    ];

    /**
     * @return BelongsTo<MatchModel, MatchStat>
     */
    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchModel::class, 'match_id');
    }

    /**
     * @return BelongsTo<Player, MatchStat>
     */
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    /**
     * @return BelongsTo<Team, MatchStat>
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
