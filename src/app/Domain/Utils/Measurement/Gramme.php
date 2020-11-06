<?php

declare(strict_types=1);

namespace App\Domain\Utils\Measurement;

use App\Domain\Utils\Measurement\Measurement;

final class Gramme implements Measurement
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getFormatedQuantity()
    {
        return $this->quantity . 'g';
    }
}