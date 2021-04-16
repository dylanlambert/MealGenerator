<?php

declare(strict_types=1);

namespace App\Domain\Utils\Measurement;

final class Gramme implements Measurement
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getFormatedQuantity(): string
    {
        return $this->quantity . 'g';
    }

    /**
     * @inheritdoc
     */
    public function match(callable $ifUnit, callable $ifGramme, callable $ifMillimeter)
    {
        return $ifGramme();
    }

    public function addQuantity(int $qtyToAdd): self
    {
        return new self($this->getQuantity() + $qtyToAdd);
    }
}
