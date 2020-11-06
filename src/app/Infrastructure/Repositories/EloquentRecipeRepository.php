<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Ingredient;
use App\Domain\Entities\MeasuredIngredient;
use App\Domain\Entities\MeasuredIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Entities\RecipeList;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Id\Id;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\Measurement\Milliliter;
use App\Domain\Utils\Measurement\Unit;
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
            $model->preparation_time,
            $this->measuredIngredientListFromRecipeModel($model),
        );
    }

    public function get(): RecipeList
    {
        $collection = RecipeModel::all();
        /** @var Recipe $recipes */
        $recipes = $collection->map(function (RecipeModel $recipe) {
            new Recipe(
                Id::fromString($recipe->id),
                $recipe->name,
                $recipe->preparation_time,
                $this->measuredIngredientListFromRecipeModel($recipe),
            );
        });

        return new RecipeList($recipes);
    }

    private function measuredIngredientListFromRecipeModel(RecipeModel $model)
    {
        return new MeasuredIngredientList(
            ... $model->recipeIngredient->map(
            function (RecipeIngredient $recipeIngredient) {

                switch ($recipeIngredient->measurement) {
                    case 'unit' :
                        $measurement = new Unit($recipeIngredient->quantity);
                        break;
                    case 'gramme' :
                        $measurement = new Gramme($recipeIngredient->quantity);
                        break;
                    case 'milliliter' :
                        $measurement = new Milliliter($recipeIngredient->quantity);
                        break;
                    default :
                        throw new \Exception('should not happened');
                }

                return new MeasuredIngredient(
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
}
