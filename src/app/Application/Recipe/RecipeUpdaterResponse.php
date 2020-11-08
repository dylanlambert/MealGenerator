<?php

declare(strict_types=1);

namespace App\Application\Recipe;

final class RecipeUpdaterResponse
{
    private bool $registered;

    public function __construct(bool $registered)
    {
        $this->registered = $registered;
    }

    public function isRegistered(): bool
    {
        return $this->registered;
    }
}
