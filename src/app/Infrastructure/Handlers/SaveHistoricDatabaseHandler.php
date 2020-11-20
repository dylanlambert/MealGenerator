<?php

declare(strict_types=1);

namespace App\Infrastructure\Handlers;

use App\Domain\Commands\SaveHistoric;
use App\Domain\Utils\Id\IdFactory;
use App\Historic;

final class SaveHistoricDatabaseHandler
{
    private IdFactory $idFactory;

    public function __construct(IdFactory $idFactory)
    {
        $this->idFactory = $idFactory;
    }

    public function handle(SaveHistoric $command): void
    {
        $id = $this->idFactory->generateId();

        foreach ($command->getRecipesId() as $recipeId) {
            $model = new Historic();
            $model->id = $id;
            $model->name = $command->getName();
            $model->recipe_id = (string) $recipeId;
            $model->save();
        }
    }
}
