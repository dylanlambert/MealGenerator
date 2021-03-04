<?php

declare(strict_types=1);

namespace App\Infrastructure\Utils;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;

final class UserUtil
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function connect(string $email, string $password): ?User
    {
        return $this->userRepository->connection($email, $password);
    }
}
