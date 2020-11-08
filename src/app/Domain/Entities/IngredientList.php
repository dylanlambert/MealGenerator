<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Exceptions\NotFoundException;
use App\Domain\Utils\Id\Id;

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

    public function map(callable $callable): array
    {
        return array_map($callable, $this->ingredients);
    }
}
