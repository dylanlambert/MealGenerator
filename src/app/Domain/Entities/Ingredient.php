<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Utils\Id\Id;

final class Ingredient
{
    private Id $id;
    private string $name;

    public function __construct(Id $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
