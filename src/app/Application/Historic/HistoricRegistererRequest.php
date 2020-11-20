<?php

declare(strict_types=1);

namespace App\Application\Historic;

use App\Domain\Utils\Id\Id;

final class HistoricRegistererRequest
{
    private string $name;
    /** @var Id[] */
    private array $recipesId;

    public function __construct(string $name, array $recipesId)
    {
        $this->recipesId = $recipesId;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /** @return Id[] */
    public function getRecipesId(): array
    {
        return $this->recipesId;
    }
}
