<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Commands\InscrireUser;
use App\Domain\Repositories\UserRepository;
use App\Domain\Utils\Application\CommandBus;

final class Inscription
{
    private CommandBus $commandBus;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(CommandBus $commandBus, UserRepository $userRepository)
    {
        $this->commandBus = $commandBus;
        $this->userRepository = $userRepository;
    }

    public function inscrire(InscriptionRequest $request): InscriptionResponse
    {
        $command = new InscrireUser(
            $request->email(),
            $request->password(),
            $request->nom(),
            $request->prenom(),
        );

        $user = $this->userRepository->findUserByEmail($request->email());

        if($user !== null) {
            return new InscriptionResponse(false);
        }

        try {
            $this->commandBus->dispatch($command);
        } catch (\Exception $exception) {
            return new InscriptionResponse(false);
        }

        return new InscriptionResponse(true);
    }
}
