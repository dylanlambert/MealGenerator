<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Recipe;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Id;
use App\Infrastructure\Utils\Uuid;
use App\Recipe as RecipeModel;

final class EloquentRecipeRepository implements RecipeRepository
{
    public function find(Id $id): Recipe
    {
        try {
            $model = RecipeModel::findOrFail((string) $id);
        } catch (\Exception $exception) {
            throw new NotFoundException();
        }

        return new Recipe(
            Uuid::fromString($model->id),
            $model->name,
            $model->preparation_time
        );
    }
}
