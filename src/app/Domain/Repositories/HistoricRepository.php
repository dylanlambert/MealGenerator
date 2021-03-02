<?php


namespace App\Domain\Repositories;


use App\Domain\Entities\Historic;
use App\Domain\Utils\Id\Id;

interface HistoricRepository
{
    public function find(Id $id): Historic;
}
