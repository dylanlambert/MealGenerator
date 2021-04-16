<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use function array_map;

final class IngredientList
{
    /** @var Ingredient[] */
    private array $ingredients;

    public function __construct(Ingredient ...$ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @template T
     * @param callable(Ingredient):T $callable
     * @return Ingredient[]
     * @phpstan-return T[]
     */
    public function map(callable $callable): array
    {
        return array_map($callable, $this->ingredients);
    }
}
