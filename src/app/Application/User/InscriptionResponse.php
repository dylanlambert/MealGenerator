<?php

declare(strict_types=1);

namespace App\Application\User;

final class InscriptionResponse
{
    private bool $inscrit;

    public function __construct(bool $inscrit)
    {
        $this->inscrit = $inscrit;
    }

    public function isInscrit():bool
    {
        return $this->inscrit;
    }
}
