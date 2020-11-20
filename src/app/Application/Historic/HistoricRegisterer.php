<?php

declare(strict_types=1);

namespace App\Application\Historic;

use App\Domain\Commands\SaveHistoric;
use App\Domain\Utils\Application\CommandBus;

final class HistoricRegisterer
{
    /**
     * @var CommandBus
     */
    private CommandBus $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function register(HistoricRegistererRequest $request):HistoricRegistererResponse
    {
        $command = new SaveHistoric(
            $request->getName(),
            $request->getRecipesId(),
        );

        $this->commandBus->dispatch($command);

        return new HistoricRegistererResponse(true);
    }
}
