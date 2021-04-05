<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Domain\Utils\Id\Id;

final class RecipeRegistererResponse
{
    private Id $recipeId;

    public function __construct(Id $recipeId)
    {
        $this->recipeId = $recipeId;
    }

    public function isRegistered(): bool
    {
        return $this->recipeId !== null;
    }

    public function recipeId(): Id
    {
        return $this->recipeId;
    }
}
