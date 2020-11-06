<?php

declare(strict_types=1);

namespace App\Application\Recipes;

use App\Domain\Entities\RecipeList;

final class RecipesRetrieverResponse
{
    private RecipeList $recipes;

    public function __construct(RecipeList $recipes)
    {
        $this->recipes = $recipes;
    }

    public function getRecipes(): RecipeList
    {
        return $this->recipes;
    }
}
