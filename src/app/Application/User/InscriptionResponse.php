<?php

declare(strict_types=1);

namespace App\Application\User;

final class InscriptionResponse
{
    private ?string $error;

    public function __construct(?string $error)
    {
        $this->error = $error;
    }

    public function isInscrit():bool
    {
        return $this->error === null;
    }

    public function error():?string
    {
        return $this->error;
    }
}
