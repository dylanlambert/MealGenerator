<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Ingredient;
use App\Domain\Entities\IngredientList;
use App\Domain\Entities\MeasuredIngredientList;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\IngredientRepository;
use App\Domain\Utils\Id\Id;
use App\Ingredient as IngredientModel;

final class EloquentIngredientRepository implements IngredientRepository
{

    public function find(Id $id): Ingredient
    {
        try {
            $model = IngredientModel::findOrFail((string) $id);
        } catch (\Exception $exception) {
            throw new NotFoundException();
        }

        return new Ingredient(
            Uuid::fromString($model->id),
            $model->name,
        );
    }

    public function get(): IngredientList
    {
        $collection = IngredientModel::all();
        /** @var Ingredient $ingredients */
        $ingredients = $collection->map(function (IngredientModel $ingredient) {
            new Ingredient(
                Id::fromString($ingredient->id),
                $ingredient->name,
            );
        });

        return new IngredientList($ingredients);
    }

    public function getByRecipe(Id $recipeId): MeasuredIngredientList
    {
        // TODO: Implement getByRecipe() method.
    }
}
