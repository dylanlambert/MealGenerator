<?php

declare(strict_types=1);

namespace App\Application\Historic;

final class HistoricDto
{
    private string $name;
    private array $recipeDto;

    public function __construct(string $name, array $recipeDto)
    {
        $this->name = $name;
        $this->recipeDto = $recipeDto;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRecipeDto(): array
    {
        return $this->recipeDto;
    }
}
