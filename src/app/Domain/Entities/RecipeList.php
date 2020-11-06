<?php

declare(strict_types=1);

namespace App\Domain\Entities;

final class RecipeList
{
    /**
     * @var Recipe[]
     */
    private array $recipes;

    public function __construct(Recipe  ...$recipes)
    {
        $this->recipes = $recipes;
    }

    /**
     * @template T
     * @param callable(Recipe): T $callable
     * @return mixed[]
     * @phpstan-return array<int, T>
     */
    public function map(callable $callable): array
    {
        return array_map($callable, $this->recipes);
    }

    public function getUnderPreparationTime(int $preparationTime)
    {
        $recipes = array_filter(
            $this->recipes,
            fn(Recipe $recipe) => $recipe->getPreparationTime() <= $preparationTime,
        );

        return new self(...$recipes);
    }

    public function isEmpty()
    {
        return count($this->recipes) <= 0;
    }
}
