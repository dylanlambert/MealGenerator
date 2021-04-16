<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Recipe
 *
 * @property string $id
 * @property string $name
 * @property int $preparation_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RecipeIngredient[] $recipeIngredient
 * @property-read int|null $recipe_ingredient_count
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe wherePreparationTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $process
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereProcess($value)
 * @property string $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Recipe whereUserId($value)
 */
final class Recipe extends Model
{
    use HasUuidPrimeryKey;

    public function recipeIngredient(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class);
    }
}
