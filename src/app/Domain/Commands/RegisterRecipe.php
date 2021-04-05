<?php

declare(strict_types=1);

namespace App\Domain\Commands;

use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Utils\Id\Id;
use App\Domain\Utils\PreparationTime\PreparationTime;

final class RegisterRecipe
{
    private string $name;
    private PreparationTime $preparationTime;
    private QuantifiedIngredientList $ingredients;
    private string $process;
    private Id $userId;
    private Id $recipeId;

    public function __construct(string $name, PreparationTime $preparationTime, QuantifiedIngredientList $ingredients, string $process, Id $userId, Id $recipeId)
    {
        $this->name = $name;
        $this->preparationTime = $preparationTime;
        $this->ingredients = $ingredients;
        $this->process = $process;
        $this->userId = $userId;
        $this->recipeId = $recipeId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function preparationTime(): PreparationTime
    {
        return $this->preparationTime;
    }

    public function ingredients(): QuantifiedIngredientList
    {
        return $this->ingredients;
    }

    public function process(): string
    {
        return $this->process;
    }

    public function userId(): Id
    {
        return $this->userId;
    }

    public function recipeId(): Id
    {
        return $this->recipeId;
    }
}
