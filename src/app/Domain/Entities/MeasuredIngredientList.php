<?php

declare(strict_types=1);

namespace App\Domain\Entities;

final class MeasuredIngredientList
{
    /** @var MeasuredIngredient[] */
    private array $measuredIngredients;

    public function __construct(MeasuredIngredient ...$ingredient)
    {
        $this->measuredIngredients = $ingredient;
    }

    public function map(callable $callable)
    {
        return array_map($callable, $this->measuredIngredients);
    }
}
