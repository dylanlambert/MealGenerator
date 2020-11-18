<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Application\Recipe\Dto\QuantifiedIngredientDto;
use App\Application\Recipe\Dto\RecipeDto;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\RecipeRepository;

final class RecipeRetriever
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function retrieve(RecipeRetrieverRequest $request): RecipeRetrieverResponse
    {
        try {
            $recipe = $this->recipeRepository->find($request->getId());

            $recipeDto = new RecipeDto(
                (string) $recipe->getId(),
                $recipe->getName(),
                $recipe->getPreparationTime(),
                $recipe->getMeasuredIngredients()->map(
                    fn(QuantifiedIngredient $ingredient) => new QuantifiedIngredientDto(
                        (string) $ingredient->getIngredient()->getId(),
                        $ingredient->getIngredient()->getName(),
                        $ingredient->getQuantity()->getFormatedQuantity(),
                        $ingredient->getQuantity()->getQuantity(),
                        $ingredient->getQuantity()->match(
                            fn()=>'unit',
                            fn()=>'gramme',
                            fn()=>'milliliter',
                        )
                    )
                ),
                sprintf('/recipe/%s', $recipe->getId()),
                $recipe->getRecipe(),
            );

            return new RecipeRetrieverResponse($recipeDto);

        } catch (NotFoundException $exception) {
            return new RecipeRetrieverResponse(null);
        }
    }
}
