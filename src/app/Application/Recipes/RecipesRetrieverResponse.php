<?php

declare(strict_types=1);

namespace App\Application\Recipes;

use App\Application\Recipe\Dto\RecipeDto;

final class RecipesRetrieverResponse
{
    /**
     * @var RecipeDto[]
     */
    private array $recipes;

    /**
     * @param RecipeDto[] $recipes
     */
    public function __construct(array $recipes)
    {
        $this->recipes = $recipes;
    }

    /**
     * @return RecipeDto[]
     */
    public function getRecipes(): array
    {
        return $this->recipes;
    }
}
