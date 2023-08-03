<?php

namespace App\Models;

use App\Models\Contracts\Listable as ListableContract;
use App\Models\Traits\Listable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\MatchModel
 *
 * @property int $id
 * @property string $match_name
 * @property string $match_date
 * @property int $team1_id
 * @property int|null $team1_score
 * @property int $team2_id
 * @property int|null $team2_score
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\Team $team1
 * @property-read \App\Models\Team $team2
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel filterExact(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel filterLike(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel sort(string $column = 'created_at', string $direction = 'true')
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereMatchDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereMatchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereTeam1Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereTeam1Score($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereTeam2Id($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereTeam2Score($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereUpdatedAt($value)
 * @property int|null $match_year
 * @method static \Illuminate\Database\Eloquent\Builder|MatchModel whereMatchYear($value)
 * @mixin \Eloquent
 */
class MatchModel extends Model
{
    use HasFactory;

    /**
     * Since Match keyword is PHP Reserved, class is renamed to MatchModel
     * Hence defining the table name
     */
    protected $table = 'matches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'match_name',
        'match_date',
        'match_year',
        'team1_id',
        'team1_score',
        'team2_id',
        'team2_score'
    ];

    /**
     * @return BelongsTo<Team, MatchModel>
     */
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    /**
     * @return BelongsTo<Team, MatchModel>
     */
    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }
}
