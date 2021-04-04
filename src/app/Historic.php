<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Historic
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Historic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Historic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Historic query()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Recipe[] $recipe
 * @property-read int|null $recipe_count
 * @property int $id
 * @property string $name
 * @property string $recipe_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Historic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Historic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Historic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Historic whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Historic whereUpdatedAt($value)
 * @property string $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Historic whereUserId($value)
 */
final class Historic extends Model
{
    public function recipe():HasMany
    {
        return $this->hasMany(Recipe::class);
    }
}
