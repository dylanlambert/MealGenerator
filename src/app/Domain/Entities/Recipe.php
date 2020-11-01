<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Utils\Id;

final class Recipe
{
    private Id $id;
    private string $name;
    private int $preparationTime;

    public function __construct(Id $id, string $name, int $preparationTime)
    {
        $this->id = $id;
        $this->name = $name;
        $this->preparationTime = $preparationTime;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPreparationTime(): int
    {
        return $this->preparationTime;
    }
}
