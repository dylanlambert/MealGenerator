<?php

namespace spec\App\Application\Recipe;

use App\Application\Recipe\Dto\QuantifiedIngredientDto;
use App\Application\Recipe\Dto\OldRecipeDto;
use App\Application\Recipe\RecipeRetrieverRequest;
use App\Domain\Entities\Ingredient;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\Measurement\Milliliter;
use App\Domain\Utils\PreparationTime\PreparationTime;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class RecipeRetrieverSpec extends ObjectBehavior
{
    public function let(RecipeRepository $recipeRepository)
    {
        $this->beConstructedWith($recipeRepository);
    }

    public function it_retrieves_recipe(RecipeRepository $recipeRepository)
    {
        $request = new RecipeRetrieverRequest(new StringId('recipe-id'));

        $measuredIngredients = new QuantifiedIngredientList(
            ...[
                new QuantifiedIngredient(
                    new Gramme(100),
                    new Ingredient(new StringId('ingredient-id-1'), 'Fromage')
                ),
                new QuantifiedIngredient(
                    new Milliliter(200),
                    new Ingredient(new StringId('ingredient-id-2'), 'Crème')
                ),
            ]
        );
        $recipeEntity = new Recipe(
            $request->getId(),
            'Recipe Name',
            new PreparationTime(600),
            $measuredIngredients,
            'process',
        );

        $recipeRepository->find($request->getId())->shouldBeCalled()->willReturn($recipeEntity);

        $recipeDto = new OldRecipeDto(
            'recipe-id',
            'Recipe Name',
            new PreparationTime(600),
            [
                new QuantifiedIngredientDto('ingredient-id-1', 'Fromage', '100g', 100, 'gramme'),
                new QuantifiedIngredientDto('ingredient-id-2', 'Crème', '20cl', 200, 'milliliter'),
            ],
            '/recipe/recipe-id',
            'process',
        );

        $this->retrieve($request)->getRecipe()->shouldBeLike($recipeDto);
    }

    public function it_returns_null_when_not_found(RecipeRepository $recipeRepository)
    {
        $request = new RecipeRetrieverRequest(new StringId('recipe-id'));

        $recipeRepository->find(Argument::any())->shouldBeCalled()->willThrow(NotFoundException::class);

        $this->retrieve($request)->getRecipe()->shouldBeLike(null);
    }
}
