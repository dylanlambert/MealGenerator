<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Historic;
use App\Domain\Repositories\HistoricRepository;
use App\Domain\Utils\Id\Id;

final class EloquentHistoricRepository implements HistoricRepository
{
    public function find(Id $id): Historic
    {
        $historicModel = \App\Historic::whereId((string) $id);
    }
}
