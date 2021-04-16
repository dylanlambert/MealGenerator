<?php

declare(strict_types=1);

namespace App\Application\Recipes;

use App\Application\Recipe\Dto\RecipeDto;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\Recipe;
use App\Domain\Repositories\RecipeRepository;

final class ApiRecipesRetriever
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function retrieve(RecipesRetrieverRequest $request): RecipesRetrieverResponse
    {
        $recipes = $this->recipeRepository->get();

        $recipesDto = $recipes
            ->map(
                fn (Recipe $recipe) => new RecipeDto(
                    $recipe->getId()->toString(),
                    $recipe->getName(),
                    $recipe->getPreparationTime()->getFormattedPreparationTime(),
                    $recipe->getMeasuredIngredients()->map(
                        function (QuantifiedIngredient $ingredient) {
                            return
                                [
                                    'ingredientName' => $ingredient->getIngredient()->getName(),
                                    'quantity' => $ingredient->getQuantity()->getFormatedQuantity(),
                                ];
                        }
                    ),
                    $recipe->getRecipe(),
                )
            );

        return new RecipesRetrieverResponse($recipesDto);
    }
}
