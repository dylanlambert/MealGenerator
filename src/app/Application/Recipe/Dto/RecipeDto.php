<?php

declare(strict_types=1);

namespace App\Application\Recipe\Dto;

final class RecipeDto
{
    private string $name;
    private string $preparationTime;
    private array $ingredients;
    private string $url;

    public function __construct(string $name, string $preparationTime, array $ingredients, string $url)
    {
        $this->name = $name;
        $this->preparationTime = $preparationTime;
        $this->ingredients = $ingredients;
        $this->url = $url;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPreparationTime(): string
    {
        return $this->preparationTime;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
