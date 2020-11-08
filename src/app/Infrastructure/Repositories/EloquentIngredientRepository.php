<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Ingredient;
use App\Domain\Entities\IngredientList;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\IngredientRepository;
use App\Domain\Utils\Id\Id;
use App\Infrastructure\Utils\Uuid;
use App\Ingredient as IngredientModel;
use Illuminate\Database\Eloquent\Collection;

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
        $ingredients = $this->constructFromCollection($collection);

        return new IngredientList(...$ingredients);
    }

    public function getByIds(array $ids): IngredientList
    {
        $ids = array_map(fn(Id $id) => (string) $id, $ids);
        $collection = IngredientModel::find($ids);
        $ingredients = $this->constructFromCollection($collection);
        return new IngredientList(...$ingredients);
    }

    /**
     * @param Collection $collection
     * @return mixed
     */
    private function constructFromCollection(Collection $collection)
    {
        return $collection->map(function (IngredientModel $ingredient) {
            return new Ingredient(
                Uuid::fromString($ingredient->id),
                $ingredient->name,
            );
        });
    }
}
