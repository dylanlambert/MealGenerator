<?php

declare(strict_types=1);

namespace App\Application\Recipe\Dto;

use App\Domain\Utils\PreparationTime\PreparationTime;

/**
 * Class OldRecipeDto
 * @package App\Application\Recipe\Dto
 * @deprecated
 */
final class OldRecipeDto
{
    private string $id;
    private string $name;
    private PreparationTime $preparationTime;
    private array $ingredients;
    private string $url;
    private string $recipe;

    public function __construct(string $id, string $name, PreparationTime $preparationTime, array $ingredients, string $url, string $recipe)
    {
        $this->id = $id;
        $this->name = $name;
        $this->preparationTime = $preparationTime;
        $this->ingredients = $ingredients;
        $this->url = $url;
        $this->recipe = $recipe;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPreparationTime(): PreparationTime
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

    public function getRecipe(): string
    {
        return $this->recipe;
    }
}
