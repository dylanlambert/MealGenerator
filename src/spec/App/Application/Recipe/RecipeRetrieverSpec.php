<?php

namespace spec\App\Application\Recipe;

use App\Application\Recipe\Dto\IngredientDto;
use App\Application\Recipe\Dto\RecipeDto;
use App\Application\Recipe\RecipeRetrieverRequest;
use App\Domain\Entities\Ingredient;
use App\Domain\Entities\MeasuredIngredient;
use App\Domain\Entities\MeasuredIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\Measurement\Milliliter;
use App\Domain\Utils\PreparationTime\PreparationTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RecipeRetrieverSpec extends ObjectBehavior
{
    function let(RecipeRepository $recipeRepository)
    {
        $this->beConstructedWith($recipeRepository);
    }

    function it_retrieves_recipe(RecipeRepository $recipeRepository)
    {
        $request = new RecipeRetrieverRequest(new StringId('recipe-id'));

        $measuredIngredients = new MeasuredIngredientList(
            ...[
                new MeasuredIngredient(
                    new Gramme(100),
                    new Ingredient(new StringId('ingredient-id-1'), 'Fromage')
                ),
                new MeasuredIngredient(
                    new Milliliter(200),
                    new Ingredient(new StringId('ingredient-id-2'), 'Crème')
                ),
            ]
        );
        $recipeEntity = new Recipe(
            $request->getId(),
            'Recipe Name',
            new PreparationTime(600),
            $measuredIngredients
        );

        $recipeRepository->find($request->getId())->shouldBeCalled()->willReturn($recipeEntity);

        $recipeDto = new RecipeDto(
            'Recipe Name',
            '10 minutes',
            [
                new IngredientDto('Fromage', '100g'),
                new IngredientDto('Crème', '20cl'),
            ],
            '/recipe/recipe-id',
        );

        $this->retrieve($request)->getRecipe()->shouldBeLike($recipeDto);
    }

    function it_returns_null_when_not_found(RecipeRepository $recipeRepository)
    {
        $request = new RecipeRetrieverRequest(new StringId('recipe-id'));

        $recipeRepository->find(Argument::any())->shouldBeCalled()->willThrow(NotFoundException::class);

        $this->retrieve($request)->getRecipe()->shouldBeLike(null);
    }
}
