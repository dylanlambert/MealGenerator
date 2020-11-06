<?php

declare(strict_types=1);

namespace App\Domain\Entities;

final class IngredientList
{
    /** @var Ingredient[] */
    private array $ingredients;

    /**
     * IngredientList constructor.
     * @param Ingredient[]
     */
    public function __construct(Ingredient ...$ingredients)
    {
        $this->ingredients = $ingredients;
    }
}
