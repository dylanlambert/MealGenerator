<?php

declare(strict_types=1);

namespace App\Application\Recipe;

final class RecipeUpdaterRequest
{
    private string $recipeId;
    private string $name;
    private array $ingredients;
    private int $preparationTime;
    private string $process;

    public function __construct(string $recipeId, string $name, array $ingredients, int $preparationTime, string $process)
    {
        $this->recipeId = $recipeId;
        $this->name = $name;

        foreach ($ingredients as $index => $ingredient) {
            if($ingredient['id'] === null) {
                unset($ingredients[$index]);
            }
        }

        $this->ingredients = $ingredients;
        $this->preparationTime = $preparationTime;
        $this->process = $process;
    }

    public function getRecipeId(): string
    {
        return $this->recipeId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function getPreparationTime(): int
    {
        return $this->preparationTime;
    }

    public function getProcess(): string
    {
        return $this->process;
    }
}
