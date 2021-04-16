<?php

declare(strict_types=1);

namespace App\Application\Generator;

use App\Application\Recipe\Dto\OldRecipeDto;
use App\Application\Recipe\Dto\QuantifiedIngredientDto;

final class GeneratorResponse
{
    /**
     * @var array<int,OldRecipeDto>
     */
    private array $recipeDtoList;
    /**
     * @var QuantifiedIngredientDto[]
     */
    private array $measuredIngredientDtoList;

    /**
     * @param array<int,OldRecipeDto> $recipeDtoList
     * @param QuantifiedIngredientDto[] $measuredIngredientDtoList
     */
    public function __construct(array $recipeDtoList, array $measuredIngredientDtoList)
    {
        $this->recipeDtoList = $recipeDtoList;
        $this->measuredIngredientDtoList = $measuredIngredientDtoList;
    }

    /**
     * @return array<int,OldRecipeDto>
     */
    public function getRecipes(): array
    {
        return $this->recipeDtoList;
    }

    /**
     * @return QuantifiedIngredientDto[]
     */
    public function getIngredients(): array
    {
        return $this->measuredIngredientDtoList;
    }
}
