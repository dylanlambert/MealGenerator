<?php

declare(strict_types=1);

namespace App\Domain\Utils\Id;

final class StringId implements Id
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public static function fromString(string $id): Id
    {
        return new self($id);
    }

    public function sameAs(Id $that): bool
    {
        return $this->toString() === $that->toString();
    }

    public function toString(): string
    {
        return $this->id;
    }
}
