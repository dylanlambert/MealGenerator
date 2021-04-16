<?php

declare(strict_types=1);

namespace App\Application\Generator;

final class GeneratorRequest
{
    private int $numberOfRecipe;
    private ?int $preparationTime;

    public function __construct(int $numberOfRecipe, ?int $preparationTime)
    {
        $this->numberOfRecipe = $numberOfRecipe;
        $this->preparationTime = $preparationTime;
    }

    public function getNumberOfRecipe(): int
    {
        return $this->numberOfRecipe;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }
}
