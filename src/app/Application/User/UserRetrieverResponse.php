<?php

declare(strict_types=1);

namespace App\Application\User;

final class UserRetrieverResponse
{
    private ?string $error;
    private ?UserDto $user;

    public function __construct(?string $error, ?UserDto $user)
    {
        $this->error = $error;
        $this->user = $user;
    }

    public function error(): ?string
    {
        return $this->error;
    }

    public function user(): ?UserDto
    {
        return $this->user;
    }
}
