<?php

declare(strict_types=1);

namespace App\Application\Recipe\Dto;

final class IngredientDto
{
    private string $name;
    private string $quantity;

    public function __construct(string $name, string $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }
}
