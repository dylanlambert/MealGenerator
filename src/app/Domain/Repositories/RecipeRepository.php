<?php


namespace App\Domain\Repositories;


use App\Domain\Entities\Recipe;
use App\Domain\Utils\Id;

interface RecipeRepository
{
    public function find(Id $id): Recipe;
}
