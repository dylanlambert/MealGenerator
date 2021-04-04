<?php

declare(strict_types=1);

namespace App\Application\Recipes;

use App\Application\Recipe\Dto\QuantifiedIngredientDto;
use App\Application\Recipe\Dto\OldRecipeDto;
use App\Application\Recipe\Dto\RecipeDto;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\Recipe;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\PreparationTime\PreparationTime;

final class ApiRecipesRetriever
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @deprecated
     */
    public function oldRetrieve(ApiRecipesRetrieverRequest $request): RecipesRetrieverResponse
    {
        $recipes = $this->recipeRepository->getFromUserId($request->userId());

        if ($request->getPreparationTimeUnder() !== null) {
            $recipes = $recipes->getUnderPreparationTime(new PreparationTime($request->getPreparationTimeUnder()));
        }
        $recipesDto = $recipes
            ->map(
                fn(Recipe $recipe) => new OldRecipeDto(
                    (string)$recipe->getId(),
                    $recipe->getName(),
                    $recipe->getPreparationTime(),
                    $recipe->getMeasuredIngredients()->map(
                        fn(QuantifiedIngredient $ingredient) => new QuantifiedIngredientDto(
                            (string)$ingredient->getIngredient()->getId(),
                            $ingredient->getIngredient()->getName(),
                            $ingredient->getQuantity()->getFormatedQuantity(),
                            $ingredient->getQuantity()->getQuantity(),
                            $ingredient->getQuantity()->match(
                                fn() => 'unit',
                                fn() => 'gramme',
                                fn() => 'milliliter',
                            )
                        )
                    ),
                    sprintf('/recipe/%s', $recipe->getId()),
                    $recipe->getRecipe(),
                )
            );
        return new RecipesRetrieverResponse($recipesDto);
    }

    public function retrieve(RecipesRetrieverRequest $request): RecipesRetrieverResponse
    {
        $recipes = $this->recipeRepository->get();

        $recipesDto = $recipes
            ->map(
                fn(Recipe $recipe) => new RecipeDto(
                    (string)$recipe->getId(),
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
