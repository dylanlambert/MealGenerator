<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Commands\InscrireUser;
use App\Domain\Utils\Application\CommandBus;

final class Inscription
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function inscrire(InscriptionRequest $request): InscriptionResponse
    {
        $command = new InscrireUser(
            $request->email(),
            $request->password(),
            $request->nom(),
            $request->prenom(),
        );

        try {
            $this->commandBus->dispatch($command);
        } catch (\Exception $exception) {
            return new InscriptionResponse(false);
        }

        return new InscriptionResponse(true);
    }
}
