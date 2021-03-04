<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\User;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\UserRepository;
use App\Domain\Utils\Id\Id;
use App\Infrastructure\Utils\Uuid;

final class EloquentUserRepository implements UserRepository
{

    public function find(Id $id): User
    {
        $userModel = \App\User::whereId((string) $id)->firstOrFail();

        return new User(
            Id::fromString($userModel->id),
            $userModel->nom,
            $userModel->prenom,
            $userModel->adresse_email
        );
    }

    public function connection(string $adresseEmail, string $motDePasse): ?User
    {
        try {
            $userModel = \App\User::where('adresse_email', $adresseEmail)
                ->where('password', hash('sha512', $motDePasse))
                ->firstOrFail()
            ;
        } catch (\Exception $exception) {
            return null;
        }

        return new User(
            Uuid::fromString($userModel->id),
            $userModel->nom,
            $userModel->prenom,
            $userModel->adresse_email
        );
    }
}
