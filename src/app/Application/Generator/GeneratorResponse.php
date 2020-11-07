<?php

declare(strict_types=1);

namespace App\Application\Generator;

final class GeneratorResponse
{
    private array $recipeDtoList;

    public function __construct(array $recipeDtoList)
    {
        $this->recipeDtoList = $recipeDtoList;
    }

    public function getRecipes(): array
    {
        return $this->recipeDtoList;
    }
}
