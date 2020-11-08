<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Domain\Commands\UpdateRecipe;
use App\Domain\Entities\Ingredient;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\IngredientRepository;
use App\Domain\Utils\Application\CommandBus;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\Measurement\Milliliter;
use App\Domain\Utils\Measurement\Unit;
use App\Domain\Utils\PreparationTime\PreparationTime;
use App\Infrastructure\Utils\Uuid;

final class RecipeUpdater
{
    private CommandBus $commandBus;
    private IngredientRepository $ingredientRepository;

    public function __construct(CommandBus $commandBus, IngredientRepository $ingredientRepository)
    {
        $this->commandBus = $commandBus;
        $this->ingredientRepository = $ingredientRepository;
    }

    public function update(RecipeUpdaterRequest $request): RecipeUpdaterResponse
    {
        $ids = array_values(array_map(
            fn(array $ingredient) => Uuid::fromString($ingredient['id']),
            $request->getIngredients(),
        ));

        $ingredients = $this->ingredientRepository->getByIds($ids);

        $measuredIngredient = $ingredients->map(
            function (Ingredient $ingredient) use ($request) {
            $datas = $this->array_find(
                $request->getIngredients(),
                fn(array $date) => $date['id'] === (string)$ingredient->getId(),
            );
            $type = $datas['type'];
            switch ($type) {
                case 'unite':
                    $unit = new Unit((int) $datas['qty']);
                    break;
                case 'gramme' :
                    $unit = new Gramme((int) $datas['qty']);
                    break;
                case 'millimeter' :
                    $unit = new Milliliter((int) $datas['qty']);
                    break;
                default :
                    throw new \Exception('should not happened');
            }
            return new QuantifiedIngredient(
                $unit,
                $ingredient
            );
        });

        $command = new UpdateRecipe(
            Uuid::fromString($request->getRecipeId()),
            $request->getName(),
            new PreparationTime($request->getPreparationTime()),
            new QuantifiedIngredientList(...$measuredIngredient),
            nl2br($request->getProcess()),
        );

        try {
            $this->commandBus->dispatch($command);
        } catch (\Exception $exception) {
            return new RecipeUpdaterResponse(false);
        }

        return new RecipeUpdaterResponse(true);
    }

    private  function array_find(array $array, callable $finder)
    {
        foreach ($array as $item) {
            if ($finder($item)) {
                return $item;
            }
        }

        return null;
    }
}
