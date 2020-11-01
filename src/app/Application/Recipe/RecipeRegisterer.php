<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Domain\Commands\RecipeRegistererCommand;
use App\Domain\Utils\CommandBus;

final class RecipeRegisterer
{
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function register(RecipeRegistererRequest $request)
    {
        $command = new RecipeRegistererCommand(
            $request->getName(),
            $request->getPreparationTime()
        );

        try {
            $this->commandBus->dispatch($command);
        } catch (\Exception $exception) {
            return new RecipeRegistererResponse(false);
        }

        return new RecipeRegistererResponse(true);
    }
}
