<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Ingredient;
use App\Domain\Entities\IngredientList;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\IngredientRepository;
use App\Domain\Utils\Id\Id;
use App\Infrastructure\Utils\Uuid;
use App\Ingredient as IngredientModel;
use Illuminate\Database\Eloquent\Collection;
use Exception;

use function array_map;

final class EloquentIngredientRepository implements IngredientRepository
{
    public function find(Id $id): Ingredient
    {
        try {
            $model = IngredientModel::findOrFail($id->toString());
        } catch (Exception $exception) {
            throw new NotFoundException();
        }

        return new Ingredient(
            Uuid::fromString($model->id),
            $model->name,
        );
    }

    public function get(): IngredientList
    {
        $collection = IngredientModel::all()->sortBy('name');
        /** @var Ingredient[] $ingredients */
        $ingredients = $this->constructFromCollection($collection);

        return new IngredientList(...$ingredients);
    }

    /**
     * @param array<int,Id> $ids
     */
    public function getByIds(array $ids): IngredientList
    {
        $ids = array_map(fn (Id $id) => $id->toString(), $ids);
        $collection = IngredientModel::find($ids);
        $ingredients = $this->constructFromCollection($collection);
        return new IngredientList(...$ingredients);
    }

    private function constructFromCollection(Collection $collection): mixed
    {
        return $collection->map(function (IngredientModel $ingredient) {
            return new Ingredient(
                Uuid::fromString($ingredient->id),
                $ingredient->name,
            );
        });
    }
}
