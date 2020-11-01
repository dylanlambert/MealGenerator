<?php

declare(strict_types=1);

namespace App\Infrastructure\Handlers;

use App\Domain\Commands\RecipeRegistererCommand;
use App\Domain\Utils\IdFactory;
use App\Recipe;

final class RecipeRegisterDatabaseHandler
{
    private IdFactory $idFactory;

    public function __construct(IdFactory $idFactory)
    {
        $this->idFactory = $idFactory;
    }

    public function handle(RecipeRegistererCommand $command)
    {
        $model = new Recipe();
        $model->id = (string) $this->idFactory->generateId();
        $model->name = $command->getName();
        $model->preparation_time = $command->getPreparationTime();
        $model->save();
    }
}
