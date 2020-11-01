<?php

declare(strict_types=1);

namespace App\Infrastructure\Utils;

use App\Domain\Utils\IdFactory;
use Ramsey\Uuid\UuidFactory;

final class RamseyUuidFactory implements IdFactory
{
    private UuidFactory $uuidFactory;

    public function __construct(UuidFactory $uuidFactory)
    {
        $this->uuidFactory = $uuidFactory;
    }

    public function generateId(): Uuid
    {
        return new Uuid($this->uuidFactory->uuid4());
    }
}
