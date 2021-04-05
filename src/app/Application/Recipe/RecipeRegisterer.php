<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Domain\Commands\RegisterRecipe;
use App\Domain\Commands\UpdateRecipe;
use App\Domain\Entities\Ingredient;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Repositories\IngredientRepository;
use App\Domain\Utils\Application\CommandBus;
use App\Domain\Utils\Id\IdFactory;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\Measurement\Milliliter;
use App\Domain\Utils\Measurement\Unit;
use App\Domain\Utils\PreparationTime\PreparationTime;
use App\Infrastructure\Utils\Uuid;

final class RecipeRegisterer
{
    private CommandBus $commandBus;
    private IngredientRepository $ingredientRepository;
    private IdFactory $idFactory;

    public function __construct(CommandBus $commandBus, IngredientRepository $ingredientRepository, IdFactory $idFactory)
    {
        $this->commandBus = $commandBus;
        $this->ingredientRepository = $ingredientRepository;
        $this->idFactory = $idFactory;
    }

    public function register(RecipeRegistererRequest $request)
    {
        $ids = array_values(
            array_map(
                fn(array $ingredient) => Uuid::fromString($ingredient['id']),
                $request->ingredients(),
            )
        );

        $ingredients = $this->ingredientRepository->getByIds($ids);

        $measuredIngredient = $ingredients->map(
            function (Ingredient $ingredient) use ($request) {
                $datas = $this->array_find(
                    $request->ingredients(),
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

        $recipeId = $this->idFactory->generateId();

        $command = new RegisterRecipe(
            $request->name(),
            new PreparationTime($request->preparationTime()),
            new QuantifiedIngredientList(...$measuredIngredient),
            $request->process(),
            $request->userId(),
            $recipeId
        );

        try {
            $this->commandBus->dispatch($command);
        } catch (\Exception $exception) {
            return new RecipeRegistererResponse(null);
        }

        return new RecipeRegistererResponse($recipeId);
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
