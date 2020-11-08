<?php

declare(strict_types=1);

namespace App\Domain\Utils\Measurement;

use App\Domain\Utils\Measurement\Measurement;

final class Milliliter implements Measurement
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

    public function getFormatedQuantity()
    {
        return $this->quantity / 10 . 'cl';
    }

    public function match(callable $ifUnit, callable $ifGramme, callable $ifMillimeter)
    {
        return $ifMillimeter();
    }
}
