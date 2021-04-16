<?php

declare(strict_types=1);

namespace App\Application\Ingredient;

use App\Application\Ingredient\Dto\IngredientDto;

final class IngredientsRetrieverResponse
{
    /**
     * @var IngredientDto[]
     */
    private array $ingredients;

    /**
     * @param IngredientDto[] $ingredients
     */
    public function __construct(array $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return array<int,IngredientDto>
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }
}
