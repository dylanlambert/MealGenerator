<?php

declare(strict_types=1);

namespace App\Domain\Utils\Id;

interface Id
{
    public static function fromString(string $id): self;

    public function sameAs(self $that): bool;

    public function toString(): string;
}
