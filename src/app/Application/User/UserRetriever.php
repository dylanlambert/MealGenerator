<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Repositories\UserRepository;

final class UserRetriever
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function retrieve(UserRetrieverRequest $request): UserRetrieverResponse
    {
        $user = $this->userRepository->connection($request->userEmail(), $request->userPassword());

        if ($user === null) {
            return new UserRetrieverResponse('user not found', null);
        }

        return new UserRetrieverResponse(
            null,
            new UserDto(
                (string)$user->id(),
                $user->adresseEmail(),
                $user->nom(),
                $user->prenom()
            )
        );
    }
}
