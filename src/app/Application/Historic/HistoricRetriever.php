<?php

declare(strict_types=1);

namespace App\Application\Historic;

use App\Application\Recipe\Dto\QuantifiedIngredientDto;
use App\Application\Recipe\Dto\RecipeDto;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\Recipe;
use App\Domain\Repositories\HistoricRepository;

final class HistoricRetriever
{
    private HistoricRepository $historicRepository;

    public function __construct(HistoricRepository $historicRepository)
    {
        $this->historicRepository = $historicRepository;
    }

    public function retrieve(HistoricRetrieverRequest $request):HistoricRetrieverResponse
    {
        $historic = $this->historicRepository->find($request->getId());

        $ingredientsDto = $historic->getRecipes()->getIngredientsCombined()->map(
            fn(QuantifiedIngredient $quantifiedIngredient) => new QuantifiedIngredientDto(
                (string) $quantifiedIngredient->getIngredient()->getId(),
                $quantifiedIngredient->getIngredient()->getName(),
                $quantifiedIngredient->getQuantity()->getFormatedQuantity(),
                $quantifiedIngredient->getQuantity()->getQuantity(),
                $quantifiedIngredient->getQuantity()->match(
                    fn()=>'unit',
                    fn()=>'gramme',
                    fn()=>'milliliter',
                )
            )
        );

        return new HistoricRetrieverResponse(
            $historic->getName(),
            array_map(
                fn(Recipe $recipe) => new RecipeDto(
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
                            ),
                        ),
                    ),
                    sprintf('/recipe/%s', $recipe->getId()),
                    $recipe->getRecipe(),
                ),
                $historic->getRecipes(),
            )
        );
    }
}
