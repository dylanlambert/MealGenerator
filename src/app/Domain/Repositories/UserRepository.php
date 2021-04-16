<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Entities\User;
use App\Domain\Utils\Id\Id;

interface UserRepository
{
    public function find(Id $id): User;

    public function connection(string $adresseEmail, string $motDePasse): ?User;

    public function findUserByEmail(string $adresseEmail): ?User;
}
