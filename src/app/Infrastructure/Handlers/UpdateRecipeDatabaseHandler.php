<?php

declare(strict_types=1);

namespace App\Infrastructure\Handlers;

use App\Domain\Commands\UpdateRecipe;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\Measurement\Milliliter;
use App\Domain\Utils\Measurement\Unit;
use App\Recipe;
use App\RecipeIngredient;

final class UpdateRecipeDatabaseHandler
{
    public function handle(UpdateRecipe $command)
    {
        try {
            $model = Recipe::findOrFail((string)$command->getRecipeId());
        } catch (\Exception $exception) {
            throw new NotFoundException();
        }

        RecipeIngredient::where('recipe_id', (string) $command->getRecipeId())->delete();

        $command->getIngredients()->walk(
        function(QuantifiedIngredient $ingredient) use ($command) {
                $recipeIngredient = new RecipeIngredient();
                $recipeIngredient->ingredient_id = (string) $ingredient->getIngredient()->getId();
                $recipeIngredient->recipe_id = (string) $command->getRecipeId();
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
