<?php

declare(strict_types=1);

namespace App\Application\Recipe;

final class RecipeRegistererRequest
{
    private string $name;
    private int $preparationTime;

    public function __construct(string $name, int $preparationTime)
    {
        $this->name = $name;
        $this->preparationTime = $preparationTime;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPreparationTime(): int
    {
        return $this->preparationTime;
    }
}
