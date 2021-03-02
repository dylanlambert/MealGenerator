<?php

declare(strict_types=1);

namespace App\Application\Historic;

final class HistoricRetrieverResponse
{
    private string $name;
    private array $recipesDto;

    /**
     * HistoricRetrieverResponse constructor.
     * @param string $name
     * @param array $recipesDto
     */
    public function __construct(string $name, array $recipesDto)
    {
        $this->name = $name;
        $this->recipesDto = $recipesDto;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getRecipesDto(): array
    {
        return $this->recipesDto;
    }
}
