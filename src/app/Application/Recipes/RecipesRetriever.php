<?php

declare(strict_types=1);

namespace App\Application\Recipes;

use App\Domain\Repositories\RecipeRepository;

final class RecipesRetriever
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function retrieve(RecipesRetrieverRequest $request): RecipesRetrieverResponse
    {
        $recipes = $this->recipeRepository->get();
        return new RecipesRetrieverResponse($recipes);
    }

}
