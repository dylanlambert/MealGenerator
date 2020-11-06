<?php

declare(strict_types=1);

namespace App\Application\Recipes;

use App\Domain\Entities\RecipeList;

final class RecipesRetrieverResponse
{
    private array $recipes;

    public function __construct(array $recipes)
    {
        $this->recipes = $recipes;
    }

    public function getRecipes(): array
    {
        return $this->recipes;
    }
}
