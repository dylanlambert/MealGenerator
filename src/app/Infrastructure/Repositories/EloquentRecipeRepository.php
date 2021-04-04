<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Ingredient;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Entities\RecipeList;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Id\Id;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\Measurement\Milliliter;
use App\Domain\Utils\Measurement\Unit;
use App\Domain\Utils\PreparationTime\PreparationTime;
use App\Infrastructure\Utils\Uuid;
use App\Recipe as RecipeModel;
use App\RecipeIngredient;

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
            new PreparationTime($model->preparation_time),
            $this->measuredIngredientListFromRecipeModel($model),
            $model->process,
        );
    }

    public function get(): RecipeList
    {
        $collection = RecipeModel::all();
        /** @var Recipe $recipes */
        $recipes = $collection->map(function (RecipeModel $recipe) {
            return new Recipe(
                Uuid::fromString($recipe->id),
                $recipe->name,
                new PreparationTime($recipe->preparation_time),
                $this->measuredIngredientListFromRecipeModel($recipe),
                $recipe->process,
            );
        });

        return new RecipeList(...$recipes);
    }

    private function measuredIngredientListFromRecipeModel(RecipeModel $model)
    {
        return new QuantifiedIngredientList(
            ... $model->recipeIngredient->map(
            function (RecipeIngredient $recipeIngredient) {

                switch ($recipeIngredient->measurement) {
                    case 'unit' :
                        $measurement = new Unit($recipeIngredient->quantity);
                        break;
                    case 'gramme' :
                        $measurement = new Gramme($recipeIngredient->quantity);
                        break;
                    case 'millimeter' :
                        $measurement = new Milliliter($recipeIngredient->quantity);
                        break;
                    default :
                        throw new \Exception('should not happened');
                }

                return new QuantifiedIngredient(
                    $measurement,
                    new Ingredient(
                        Uuid::fromString($recipeIngredient->ingredient->id),
                        $recipeIngredient->ingredient->name,
                    ),
                );
            }
        )
        );
    }

    public function getFromUserId(Id $userId): RecipeList
    {
        $collection = RecipeModel::whereUserId((string) $userId)->get();
        /** @var Recipe $recipes */
        $recipes = $collection->map(function (RecipeModel $recipe) {
            return new Recipe(
                Uuid::fromString($recipe->id),
                $recipe->name,
                new PreparationTime($recipe->preparation_time),
                $this->measuredIngredientListFromRecipeModel($recipe),
                $recipe->process,
            );
        });

        return new RecipeList(...$recipes);
    }
}
