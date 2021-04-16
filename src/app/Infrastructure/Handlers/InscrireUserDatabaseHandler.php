<?php

declare(strict_types=1);

namespace App\Infrastructure\Handlers;

use App\Domain\Commands\InscrireUser;
use App\Domain\Utils\Id\IdFactory;
use App\User;

final class InscrireUserDatabaseHandler
{
    private IdFactory $idFactory;

    public function __construct(IdFactory $idFactory)
    {
        $this->idFactory = $idFactory;
    }

    public function handle(InscrireUser $command): void
    {
        $model = new User();
        $model->id = $this->idFactory->generateId()->toString();
        $model->adresse_email = $command->email();
        $model->password = $command->password();
        $model->prenom = $command->prenom();
        $model->nom = $command->nom();
        $model->save();
    }
}
