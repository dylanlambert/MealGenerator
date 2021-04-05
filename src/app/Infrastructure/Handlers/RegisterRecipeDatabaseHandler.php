<?php

declare(strict_types=1);

namespace App\Infrastructure\Handlers;

use App\Domain\Commands\RegisterRecipe;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Utils\Id\IdFactory;
use App\Recipe;
use App\RecipeIngredient;

final class RegisterRecipeDatabaseHandler
{

    public function handle(RegisterRecipe $command)
    {
        $model = new Recipe();

        $recipeId = $command->recipeId();

        $model->id = $recipeId;
        $model->name = $command->name();
        $model->preparation_time = $command->preparationTime()->getSeconds();
        $model->process = $command->process();
        $model->user_id = (string) $command->userId();

        $model->save();

        $command->ingredients()->walk(
            function(QuantifiedIngredient $ingredient) use ($command, $recipeId) {
                $recipeIngredient = new RecipeIngredient();
                $recipeIngredient->ingredient_id = (string) $ingredient->getIngredient()->getId();
                $recipeIngredient->recipe_id = (string) $recipeId;
                $ingredient->getQuantity()->match(
                    function () use ($recipeIngredient, $ingredient) {
                        $recipeIngredient->quantity = $ingredient->getQuantity()->getQuantity();
                        $recipeIngredient->measurement = 'unit';
                        return $recipeIngredient;
                    },
                    function () use ($recipeIngredient, $ingredient) {
                        $recipeIngredient->quantity = $ingredient->getQuantity()->getQuantity();
                        $recipeIngredient->measurement = 'gramme';
                        return $recipeIngredient;
                    },
                    function () use ($recipeIngredient, $ingredient) {
                        $recipeIngredient->quantity = $ingredient->getQuantity()->getQuantity();
                        $recipeIngredient->measurement = 'millimeter';
                        return $recipeIngredient;
                    }
                );
                $recipeIngredient->save();
            }
        );
    }
}
