<?php

declare(strict_types=1);

namespace App;

trait HasUuidPrimeryKey
{
    /**
     * @param array<string, mixed> $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->keyType = 'string';
        $this->incrementing = false;
        parent::__construct($attributes);
    }
}
