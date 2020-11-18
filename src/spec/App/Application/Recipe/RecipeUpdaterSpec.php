<?php

namespace spec\App\Application\Recipe;

use App\Application\Recipe\RecipeUpdaterRequest;
use App\Domain\Commands\UpdateRecipe;
use App\Domain\Entities\Ingredient;
use App\Domain\Entities\IngredientList;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Repositories\IngredientRepository;
use App\Domain\Utils\Application\CommandBus;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\Measurement\Unit;
use App\Domain\Utils\PreparationTime\PreparationTime;
use PhpSpec\ObjectBehavior;

class RecipeUpdaterSpec extends ObjectBehavior
{
    function let(CommandBus $commandBus, IngredientRepository $ingredientRepository)
    {
        $this->beConstructedWith($commandBus, $ingredientRepository);
    }

//    function it_update(CommandBus $commandBus, IngredientRepository $ingredientRepository)
//    {
//        $request = new RecipeUpdaterRequest(
//            'recipe-id',
//            'nom de la recette',
//            [
//                [
//                    'id' => '0046d3dd-dce9-4e6d-8d99-bc8175047135',
//                    'qty' => 100,
//                    'unit' => 'gramme',
//                ],
//                [
//                    'id' => '0060bdca-6d68-4404-924b-c51bb937181b',
//                    'qty' => 3,
//                    'unit' => 'unit',
//                ],
//
//            ],
//            600,
//            'ceci est le texte de recette'
//        );
//
//
//        $ingredient1 = new Ingredient(
//            new StringId('0046d3dd-dce9-4e6d-8d99-bc8175047135'),
//            'ingredientName',
//        );
//        $ingredient2 = new Ingredient(
//            new StringId('0060bdca-6d68-4404-924b-c51bb937181b'),
//            'ingredientName'
//        );
//
//        $ingredientsList = new IngredientList(
//            $ingredient1,
//            $ingredient2,
//        );
//
//        $ingredientRepository
//            ->getByIds(
//                [
//                    new StringId('0046d3dd-dce9-4e6d-8d99-bc8175047135'),
//                    new StringId('0060bdca-6d68-4404-924b-c51bb937181b')
//                ]
//            )
//            ->shouldBeCalled()
//            ->willReturn($ingredientsList)
//        ;
//
//        $command = new UpdateRecipe(
//            new StringId('recipe-id'),
//            'nom de la recette',
//            new PreparationTime(600),
//            new QuantifiedIngredientList(
//                new QuantifiedIngredient(
//                    new Gramme(100),
//                    $ingredient1,
//                ),
//                new QuantifiedIngredient(
//                    new Unit(3),
//                    $ingredient2
//                ),
//            ),
//            'ceci est le texte de recette',
//        );
//
//        $commandBus->dispatch($command)->shouldBeCalled();
//
//        $this->update($request)->shouldBeLike(true);
//    }
}
