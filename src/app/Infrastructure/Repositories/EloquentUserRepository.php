<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;
use App\Domain\Utils\Id\Id;
use App\Infrastructure\Utils\Uuid;
use App\User as UserModel;
use Exception;

use function hash;

final class EloquentUserRepository implements UserRepository
{
    public function find(Id $id): User
    {
        $userModel = UserModel::whereId($id->toString())->firstOrFail();

        return new User(
            Uuid::fromString($userModel->id),
            $userModel->nom,
            $userModel->prenom,
            $userModel->adresse_email
        );
    }

    public function connection(string $adresseEmail, string $motDePasse): ?User
    {
        try {
            $userModel = UserModel::where('adresse_email', $adresseEmail)
                ->where('password', hash('sha512', $motDePasse))
                ->firstOrFail()
            ;
        } catch (Exception $exception) {
            return null;
        }

        return new User(
            Uuid::fromString($userModel->id),
            $userModel->nom,
            $userModel->prenom,
            $userModel->adresse_email
        );
    }

    public function findUserByEmail(string $adresseEmail): ?User
    {
        $userModel = UserModel::firstWhere('adresse_email', $adresseEmail);

        if ($userModel !== null) {
            return new User(
                Uuid::fromString($userModel->id),
                $userModel->nom,
                $userModel->prenom,
                $userModel->adresse_email,
            );
        }

        return null;
    }
}
