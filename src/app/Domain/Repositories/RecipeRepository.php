<?php


namespace App\Domain\Repositories;


use App\Domain\Entities\Recipe;
use App\Domain\Entities\RecipeList;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Utils\Id\Id;

interface RecipeRepository
{
    /**
     * @throws NotFoundException
     */
    public function find(Id $id): Recipe;

    public function get():RecipeList;
}
