<?php

declare(strict_types=1);

namespace App\Application\Generator;

final class GeneratorResponse
{
    private array $recipeDtoList;
    private array $measuredIngredientDtoList;

    public function __construct(array $recipeDtoList, array $measuredIngredientDtoList)
    {
        $this->recipeDtoList = $recipeDtoList;
        $this->measuredIngredientDtoList = $measuredIngredientDtoList;
    }

    public function getRecipes(): array
    {
        return $this->recipeDtoList;
    }

    public function getIngredients(): array
    {
        return $this->measuredIngredientDtoList;
    }
}
