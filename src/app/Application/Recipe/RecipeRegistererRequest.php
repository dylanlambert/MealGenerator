<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Domain\Utils\Id\Id;

final class RecipeRegistererRequest
{
    private string $name;
    private array $ingredients;
    private int $preparationTime;
    private string $process;
    private Id $userId;

    public function __construct(string $name, array $ingredients, int $preparationTime, string $process, Id $userId)
    {
        $this->name = $name;
        foreach ($ingredients as $index => $ingredient) {
            if($ingredient['id'] === null) {
                unset($ingredients[$index]);
            }
        }

        $this->ingredients = $ingredients;
        $this->preparationTime = $preparationTime;
        $this->process = $process;
        $this->userId = $userId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function ingredients(): array
    {
        return $this->ingredients;
    }

    public function preparationTime(): int
    {
        return $this->preparationTime;
    }

    public function process(): string
    {
        return $this->process;
    }

    public function userId(): Id
    {
        return $this->userId;
    }
}
