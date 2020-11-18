<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Utils\PreparationTime\PreparationTime;

final class RecipeList
{
    /**
     * @var Recipe[]
     */
    private array $recipes;

    public function __construct(Recipe ...$recipes)
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

    public function getUnderPreparationTime(PreparationTime $preparationTime)
    {
        $recipes = array_filter(
            $this->recipes,
            fn(Recipe $recipe) => $recipe->getPreparationTime()->under($preparationTime),
        );

        return new self(...$recipes);
    }

    public function isEmpty()
    {
        return count($this->recipes) <= 0;
    }

    public function rand(int $number):self
    {
        $recipes = $this->recipes;
        shuffle($recipes);
        return new self(... array_slice($recipes, 0, $number));
    }

    public function getIngredientsCombined(): QuantifiedIngredientList
    {
        $quantifiedIngredients =  array_map(
            function (Recipe $recipe) {
                $list = $recipe->getMeasuredIngredients()->map(
                    fn(QuantifiedIngredient $ingredient)=>$ingredient
                );
                return [...$list];
            }, $this->recipes);

        $ingredients = new QuantifiedIngredientList(... array_merge([], ...$quantifiedIngredients));

        return $ingredients;
    }
}
