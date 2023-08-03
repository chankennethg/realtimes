<?php

namespace App\Models;

use App\Models\Contracts\Listable as ListableContract;
use App\Models\Traits\Listable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Player
 *
 * @property int $id
 * @property string|null $firstname
 * @property string $lastname
 * @property string|null $football_name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Player filter(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Player filterExact(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Player filterLike(array $filters)
 * @method static \Illuminate\Database\Eloquent\Builder|Player newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Player query()
 * @method static \Illuminate\Database\Eloquent\Builder|Player sort(string $column = 'created_at', string $direction = 'true')
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereFootballName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Player whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Player extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'football_name'
    ];
}
