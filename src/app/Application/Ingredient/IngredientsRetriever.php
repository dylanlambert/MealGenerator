<?php

declare(strict_types=1);

namespace App\Application\Ingredient;

use App\Application\Ingredient\Dto\IngredientDto;
use App\Domain\Entities\Ingredient;
use App\Domain\Repositories\IngredientRepository;

final class IngredientsRetriever
{
    private IngredientRepository $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function retrieve(): IngredientsRetrieverResponse
    {
        $ingredients = $this->ingredientRepository->get();
        $dtos = $ingredients->map(
            fn (Ingredient $ingredient) => new IngredientDto(
                $ingredient->getId()->toString(),
                $ingredient->getName(),
            )
        );

        return new IngredientsRetrieverResponse($dtos);
    }
}
