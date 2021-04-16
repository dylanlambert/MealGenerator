<?php

declare(strict_types=1);

namespace App\Application\Recipes;

use App\Application\Recipe\Dto\OldRecipeDto;

final class OldRecipesRetrieverResponse
{
    /**
     * @var OldRecipeDto[]
     */
    private array $recipes;

    /**
     * @param OldRecipeDto[] $recipes
     */
    public function __construct(array $recipes)
    {
        $this->recipes = $recipes;
    }

    /**
     * @return OldRecipeDto[]
     */
    public function getRecipes(): array
    {
        return $this->recipes;
    }
}
