<?php


namespace App\Domain\Utils\Id;


use Ramsey\Uuid\Uuid as RamseyUuid;

interface Id
{
    public static function fromString(string $id): self;
}
