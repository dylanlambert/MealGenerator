<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use App\Domain\Utils\Id\Id;

final class User
{
    private Id $id;
    private string $nom;
    private string $prenom;
    private string $adresseEmail;

    public function __construct(Id $id, string $nom, string $prenom, string $adresseEmail)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresseEmail = $adresseEmail;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function nom(): string
    {
        return $this->nom;
    }

    public function prenom(): string
    {
        return $this->prenom;
    }

    public function adresseEmail(): string
    {
        return $this->adresseEmail;
    }
}
