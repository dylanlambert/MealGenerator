<?php

declare(strict_types=1);

namespace App\Domain\Commands;

use App\Domain\Utils\Id\Id;

final class SaveHistoric
{
    private string $name;
    /** @var Id[] */
    private array $recipesId;

    /**
     * @param Id[] $recipesId
     */
    public function __construct(string $name, array $recipesId)
    {
        $this->name = $name;
        $this->recipesId = $recipesId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Id[]
     */
    public function getRecipesId(): array
    {
        return $this->recipesId;
    }
}
