<?php

declare(strict_types=1);

namespace App\Application\Recipes;

use App\Domain\Utils\Id\Id;

final class ApiRecipesRetrieverRequest
{
    private ?int $preparationTimeUnder;
    private Id $userId;

    public function __construct(?int $preparationTimeUnder, Id $userId)
    {
        $this->preparationTimeUnder = $preparationTimeUnder;
        $this->userId = $userId;
    }

    public function getPreparationTimeUnder(): ?int
    {
        return $this->preparationTimeUnder;
    }

    public function userId(): Id
    {
        return $this->userId;
    }
}
