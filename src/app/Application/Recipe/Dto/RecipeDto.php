<?php

declare(strict_types=1);

namespace App\Application\Recipe\Dto;

final class RecipeDto
{
    private string $name;
    private string $preparationTime;

    public function __construct(string $name, string $preparationTime)
    {
        $this->name = $name;
        $this->preparationTime = $preparationTime;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPreparationTime(): string
    {
        return $this->preparationTime;
    }
}
