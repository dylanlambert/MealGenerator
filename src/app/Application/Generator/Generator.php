<?php

declare(strict_types=1);

namespace App\Application\Generator;

use App\Application\Recipe\Dto\QuantifiedIngredientDto;
use App\Application\Recipe\Dto\RecipeDto;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\Recipe;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\PreparationTime\PreparationTime;

final class Generator
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function generate(GeneratorRequest $request): GeneratorResponse
    {
        $recipes = $this->recipeRepository->get();
        if($request->getPreparationTime() !== null) {
            $recipes = $recipes->getUnderPreparationTime(new PreparationTime($request->getPreparationTime()));
        }
        $recipes = $recipes->rand($request->getNumberOfRecipe());

        $recipesDto = $recipes->map(
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
            )
        );

        $ingredientsDto = $recipes->getIngredientsCombined()->map(
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

        return new GeneratorResponse($recipesDto, $ingredientsDto);
    }
}
