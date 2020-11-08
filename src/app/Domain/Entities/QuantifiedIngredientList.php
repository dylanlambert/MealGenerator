<?php

declare(strict_types=1);

namespace App\Domain\Entities;

final class QuantifiedIngredientList
{
    /** @var QuantifiedIngredient[] */
    private array $measuredIngredients;

    public function __construct(QuantifiedIngredient ...$ingredient)
    {
        $this->measuredIngredients = $ingredient;
    }

    public function map(callable $callable)
    {
        return array_map($callable, $this->measuredIngredients);
    }

    public function walk(callable $callable)
    {
        array_walk($this->measuredIngredients, $callable);
    }
}
