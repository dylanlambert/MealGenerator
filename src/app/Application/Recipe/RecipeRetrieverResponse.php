<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Application\Recipe\Dto\RecipeDto;

final class RecipeRetrieverResponse
{
    private RecipeDto $recipe;

    public function __construct(RecipeDto $recipe)
    {
        $this->recipe = $recipe;
    }

    public function getRecipe(): RecipeDto
    {
        return $this->recipe;
    }
}
