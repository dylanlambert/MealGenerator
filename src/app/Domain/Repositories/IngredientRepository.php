<?php


namespace App\Domain\Repositories;


use App\Domain\Entities\Ingredient;
use App\Domain\Entities\IngredientList;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Utils\Id\Id;

interface IngredientRepository
{
    public function find(Id $id):Ingredient;

    public function get():IngredientList;

    public function getByIds(array $ids): IngredientList;
}
