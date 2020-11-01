<?php


namespace App\Domain\Repositories;


use App\Domain\Entities\Recipe;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Utils\Id;

interface RecipeRepository
{
    /**
     * @throws NotFoundException
     */
    public function find(Id $id): Recipe;
}
