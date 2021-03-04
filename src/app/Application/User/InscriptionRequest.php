<?php

declare(strict_types=1);

namespace App\Application\User;

final class InscriptionRequest
{
    private string $email;
    private string $password;
    private string $nom;
    private string $prenom;

    public function __construct(string $email, string $password, string $nom, string $prenom)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return hash('sha512', $this->password);
    }

    public function nom(): string
    {
        return $this->nom;
    }

    public function prenom(): string
    {
        return $this->prenom;
    }
}
