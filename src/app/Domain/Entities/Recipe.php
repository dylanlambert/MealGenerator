<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Utils\Id\Id;
use App\Domain\Utils\PreparationTime\PreparationTime;

final class Recipe
{
    private Id $id;
    private string $name;
    private PreparationTime $preparationTime;
    private QuantifiedIngredientList $measuredIngredients;
    private string $recipe;

    public function __construct(
        Id $id,
        string $name,
        PreparationTime $preparationTime,
        QuantifiedIngredientList $measuredIngredients,
        string $recipe
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->preparationTime = $preparationTime;
        $this->measuredIngredients = $measuredIngredients;
        $this->recipe = $recipe;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPreparationTime(): PreparationTime
    {
        return $this->preparationTime;
    }

    public function getMeasuredIngredients(): QuantifiedIngredientList
    {
        return $this->measuredIngredients;
    }

    public function getRecipe(): string
    {
        return $this->recipe;
    }
}
