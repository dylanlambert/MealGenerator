<?php

declare(strict_types=1);

namespace App\Application\Recipes;

use App\Application\Recipe\Dto\QuantifiedIngredientDto;
use App\Application\Recipe\Dto\OldRecipeDto;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\Recipe;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\PreparationTime\PreparationTime;

use function sprintf;

final class RecipesRetriever
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @deprecated
     */
    public function oldRetrieve(RecipesRetrieverRequest $request): OldRecipesRetrieverResponse
    {
        $recipes = $this->recipeRepository->get();

        if ($request->getPreparationTimeUnder() !== null) {
            $recipes = $recipes->getUnderPreparationTime(new PreparationTime($request->getPreparationTimeUnder()));
        }
        $recipesDto = $recipes
            ->map(
                fn (Recipe $recipe) => new OldRecipeDto(
                    $recipe->getId()->toString(),
                    $recipe->getName(),
                    $recipe->getPreparationTime(),
                    $recipe->getMeasuredIngredients()->map(
                        fn (QuantifiedIngredient $ingredient) => new QuantifiedIngredientDto(
                            $ingredient->getIngredient()->getId()->toString(),
                            $ingredient->getIngredient()->getName(),
                            $ingredient->getQuantity()->getFormatedQuantity(),
                            $ingredient->getQuantity()->getQuantity(),
                            $ingredient->getQuantity()->match(
                                fn () => 'unit',
                                fn () => 'gramme',
                                fn () => 'milliliter',
                            )
                        )
                    ),
                    sprintf('/recipe/%s', $recipe->getId()->toString()),
                    $recipe->getRecipe(),
                )
            );
        return new OldRecipesRetrieverResponse($recipesDto);
    }
}
