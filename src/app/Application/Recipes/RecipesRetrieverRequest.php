<?php

declare(strict_types=1);

namespace App\Application\Recipes;

final class RecipesRetrieverRequest
{
    private ?int $preparationTimeUnder;

    public function __construct(?int $preparationTimeUnder)
    {
        $this->preparationTimeUnder = $preparationTimeUnder;
    }

    public function getPreparationTimeUnder(): ?int
    {
        return $this->preparationTimeUnder;
    }
}
