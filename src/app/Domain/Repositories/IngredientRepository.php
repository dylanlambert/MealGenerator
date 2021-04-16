<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Entities\Ingredient;
use App\Domain\Entities\IngredientList;
use App\Domain\Utils\Id\Id;

interface IngredientRepository
{
    public function find(Id $id): Ingredient;

    public function get(): IngredientList;

    /**
     * @param array<int,Id> $ids
     */
    public function getByIds(array $ids): IngredientList;
}
