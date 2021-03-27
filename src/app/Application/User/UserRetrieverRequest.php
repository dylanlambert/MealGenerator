<?php

declare(strict_types=1);

namespace App\Application\User;

final class UserRetrieverRequest
{
    private string $userEmail;
    private string $userPassword;

    public function __construct(string $userEmail, string $userPassword)
    {
        $this->userEmail = $userEmail;
        $this->userPassword = $userPassword;
    }

    public function userEmail(): string
    {
        return $this->userEmail;
    }

    public function userPassword(): string
    {
        return $this->userPassword;
    }
}
