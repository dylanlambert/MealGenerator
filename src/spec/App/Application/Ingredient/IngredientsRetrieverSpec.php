<?php

namespace spec\App\Application\Ingredient;

use App\Application\Ingredient\Dto\IngredientDto;
use App\Application\Ingredient\IngredientsRetriever;
use App\Application\Recipe\Dto\QuantifiedIngredientDto;
use App\Domain\Entities\Ingredient;
use App\Domain\Entities\IngredientList;
use App\Domain\Repositories\IngredientRepository;
use App\Domain\Utils\Id\StringId;
use PhpSpec\ObjectBehavior;

class IngredientsRetrieverSpec extends ObjectBehavior
{
    function let(IngredientRepository $ingredientRepository)
    {
        $this->beConstructedWith($ingredientRepository);
    }

    function it_retrieves_ingredient(IngredientRepository $ingredientRepository)
    {
        $ingredients = new IngredientList(
            new Ingredient(
                new StringId('ingredient-id-1'),
                'ingrédient 1'
            ),
            new Ingredient(
                new StringId('ingredient-id-2'),
                'ingrédient 2'
            ),
        );

        $ingredientRepository->get()->shouldBeCalled()->willReturn($ingredients);

        $ingredientsDto = [
            new IngredientDto(
                'ingredient-id-1',
                'ingrédient 1'
            ),
            new IngredientDto(
                'ingredient-id-2',
                'ingrédient 2'
            ),
        ];

        $this->retrieve()->getIngredients()->shouldBeLike($ingredientsDto);
    }
}
