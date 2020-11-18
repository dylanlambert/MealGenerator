<?php


namespace App\Domain\Utils\Measurement;


interface Measurement
{
    public function getFormatedQuantity();

    public function match(callable $ifUnit, callable $ifGramme, callable $ifMillimeter);

    public function getQuantity(): int;

    public function addQuantity(int $qtyToAdd):self;
}
