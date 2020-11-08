<?php

declare(strict_types=1);

namespace App\Domain\Commands;

use App\Domain\Entities\IngredientList;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Utils\Id\Id;
use App\Domain\Utils\PreparationTime\PreparationTime;

final class UpdateRecipe
{
    private Id $recipeId;
    private string $name;
    private PreparationTime $preparationTime;
    private QuantifiedIngredientList $ingredients;
    private string $process;

    public function __construct(Id $recipeId, string $name, PreparationTime $preparationTime, QuantifiedIngredientList $ingredients, string $process)
    {
        $this->recipeId = $recipeId;
        $this->name = $name;
        $this->preparationTime = $preparationTime;
        $this->ingredients = $ingredients;
        $this->process = $process;
    }

    public function getRecipeId(): Id
    {
        return $this->recipeId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPreparationTime(): PreparationTime
    {
        return $this->preparationTime;
    }

    public function getIngredients(): QuantifiedIngredientList
    {
        return $this->ingredients;
    }

    public function getProcess(): string
    {
        return $this->process;
    }
}
