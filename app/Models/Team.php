<?php

namespace App\Models;

use App\Models\Traits\Listable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contracts\Listable as ListableContract;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatchModel> $team1Matches
 * @property-read int|null $team1_matches_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\MatchModel> $team2Matches
 * @property-read int|null $team2_matches_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Team filterExact(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Team filterLike(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team sort(string $column = 'created_at', string $direction = 'true')
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'short_name',
    ];

    /**
     * @return HasMany<MatchModel>
     */
    public function team1Matches(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'team1_id');
    }

    /**
     * @return HasMany<MatchModel>
     */
    public function team2Matches(): HasMany
    {
        return $this->hasMany(MatchModel::class, 'team2_id');
    }
}
