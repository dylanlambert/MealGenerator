<?php

declare(strict_types=1);

namespace App\Application\Recipe\Dto;

final class QuantifiedIngredientDto
{
    private string $id;
    private string $name;
    private string $quantity;
    private int $qtyNumber;
    private string $qtyType;

    public function __construct(string $id, string $name, string $quantity, int $qtyNumber, string $qtyType)
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->id = $id;
        $this->qtyNumber = $qtyNumber;
        $this->qtyType = $qtyType;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

    public function getQtyNumber(): int
    {
        return $this->qtyNumber;
    }

    public function getQtyType(): string
    {
        return $this->qtyType;
    }
}
