<?php


namespace App\Domain\Repositories;


use App\Domain\Entities\Ingredient;
use App\Domain\Entities\IngredientList;
use App\Domain\Entities\MeasuredIngredientList;
use App\Domain\Utils\Id\Id;

interface IngredientRepository
{
    public function find(Id $id):Ingredient;

    public function get():IngredientList;

    public function getByRecipe(Id $recipeId):MeasuredIngredientList;
}
