<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Application\Recipe\Dto\OldRecipeDto;

final class RecipeRetrieverResponse
{
    private ?OldRecipeDto $recipe;

    public function __construct(?OldRecipeDto $recipe)
    {
        $this->recipe = $recipe;
    }

    public function getRecipe(): ?OldRecipeDto
    {
        return $this->recipe;
    }
}
