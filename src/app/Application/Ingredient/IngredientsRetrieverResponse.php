<?php

declare(strict_types=1);

namespace App\Application\Ingredient;

final class IngredientsRetrieverResponse
{
    private array $ingredients;

    public function __construct(array $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }
}
