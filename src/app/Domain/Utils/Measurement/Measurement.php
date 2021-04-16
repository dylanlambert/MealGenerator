<?php

declare(strict_types=1);

namespace App\Domain\Utils\Measurement;

interface Measurement
{
    public function getFormatedQuantity(): string;

    /**
     * @template T
     * @param callable():T $ifUnit
     * @param callable():T $ifGramme
     * @param callable():T $ifMillimeter
     * @return mixed
     * @phpstan-return T
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    public function match(callable $ifUnit, callable $ifGramme, callable $ifMillimeter);

    public function getQuantity(): int;

    public function addQuantity(int $qtyToAdd): self;
}
