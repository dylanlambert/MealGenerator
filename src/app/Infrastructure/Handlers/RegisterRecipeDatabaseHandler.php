<?php

declare(strict_types=1);

namespace App\Infrastructure\Handlers;

use App\Domain\Commands\RegisterRecipe;
use App\Domain\Entities\QuantifiedIngredient;
use App\Recipe;
use App\RecipeIngredient;

final class RegisterRecipeDatabaseHandler
{
    public function handle(RegisterRecipe $command): void
    {
        $model = new Recipe();

        $recipeId = $command->recipeId();

        $model->id = $recipeId->toString();
        $model->name = $command->name();
        $model->preparation_time = $command->preparationTime()->getSeconds();
        $model->process = $command->process();
        $model->user_id = $command->userId()->toString();

        $model->save();

        $command->ingredients()->walk(
            function (QuantifiedIngredient $ingredient) use ($recipeId): void {
                $recipeIngredient = new RecipeIngredient();
                $recipeIngredient->ingredient_id = $ingredient->getIngredient()->getId()->toString();
                $recipeIngredient->recipe_id = $recipeId->toString();
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
