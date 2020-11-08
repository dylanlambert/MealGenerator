<?php

declare(strict_types=1);

namespace App\Infrastructure\Utils;

use App\Domain\Utils\Id\Id;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

final class Uuid implements Id
{
    private UuidInterface $id;

    public function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public static function fromString(string $uuid): self
    {
        return new self(RamseyUuid::fromString($uuid));
    }

    public function __toString(): string
    {
        return $this->id->toString();
    }

    public function sameAs(Id $that): bool
    {
        return $that instanceof $this && $this->id->equals($that->id);
    }
}
