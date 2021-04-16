<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Utils\Measurement\Measurement;

final class QuantifiedIngredient
{
    private Measurement $quantity;
    private Ingredient $ingredient;

    public function __construct(Measurement $quantity, Ingredient $ingredient)
    {
        $this->quantity = $quantity;
        $this->ingredient = $ingredient;
    }

    public function getQuantity(): Measurement
    {
        return $this->quantity;
    }

    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }

    public function addQuantity(Measurement $measurement): self
    {
        return new self($this->quantity->addQuantity($measurement->getQuantity()), $this->ingredient);
    }
}
