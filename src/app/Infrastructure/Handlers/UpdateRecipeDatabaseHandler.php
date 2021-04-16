<?php

declare(strict_types=1);

namespace App\Infrastructure\Handlers;

use App\Domain\Commands\UpdateRecipe;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Exceptions\NotFoundException;
use App\Recipe;
use App\RecipeIngredient;
use Exception;

final class UpdateRecipeDatabaseHandler
{
    public function handle(UpdateRecipe $command): void
    {
        try {
            $model = Recipe::findOrFail($command->getRecipeId()->toString());
        } catch (Exception $exception) {
            throw new NotFoundException();
        }

        RecipeIngredient::where('recipe_id', $command->getRecipeId()->toString())->delete();

        $command->getIngredients()->walk(
            function (QuantifiedIngredient $ingredient) use ($command): void {
                $recipeIngredient = new RecipeIngredient();
                $recipeIngredient->ingredient_id = $ingredient->getIngredient()->getId()->toString();
                $recipeIngredient->recipe_id = $command->getRecipeId()->toString();
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

        $model->name = $command->getName();
        $model->preparation_time = $command->getPreparationTime()->getSeconds();
        $model->process = $command->getProcess();

        $model->save();
    }
}
