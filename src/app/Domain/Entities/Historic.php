<?php

declare(strict_types=1);

namespace App\Domain\Entities;

final class Historic
{
    private string $name;
    /** @var Recipe[] */
    private array $recipes;

    /**
     * @param Recipe[] $recipes
     */
    public function __construct(string $name, array $recipes)
    {
        $this->name = $name;
        $this->recipes = $recipes;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Recipe[]
     */
    public function getRecipes(): array
    {
        return $this->recipes;
    }
}
