<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\RecipeIngredient
 *
 * @property string $recipe_id
 * @property string $ingredient_id
 * @property string $measurement
 * @property int $quantity
 * @property-read \App\Ingredient $ingredient
 * @property-read \App\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient query()
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient whereIngredientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient whereMeasurement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecipeIngredient whereRecipeId($value)
 * @mixin \Eloquent
 */
final class RecipeIngredient extends Model
{
    use HasUuidPrimeryKey;

    /**
     * @var bool
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    public $timestamps = false;

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
