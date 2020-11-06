<?php

namespace spec\App\Application\Recipes;

use App\Application\Recipes\RecipesRetriever;
use App\Application\Recipes\RecipesRetrieverRequest;
use App\Domain\Entities\Ingredient;
use App\Domain\Entities\MeasuredIngredient;
use App\Domain\Entities\MeasuredIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Entities\RecipeList;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\Measurement\Gramme;
use PhpSpec\ObjectBehavior;

class RecipesRetrieverSpec extends ObjectBehavior
{
    function let(RecipeRepository $recipeRepository)
    {
        $this->beConstructedWith($recipeRepository);
    }

    function it_retrieves_recipes(RecipeRepository $recipeRepository)
    {
        $request = new RecipesRetrieverRequest(null);

        $recipeList = new RecipeList(
            new Recipe(
                new StringId('recipe-id-1'),
                'Recipe 1',
                600,
                new MeasuredIngredientList(
                ...[
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            )
            ),
            new Recipe(
                new StringId('recipe-id-2'),
                'Recipe 2',
                3600,
                new MeasuredIngredientList(
                ...[
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new MeasuredIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            )
            ),
        );

        $recipeRepository->get()->shouldBeCalled()->willReturn($recipeList);

        $this->retrieve($request)->getRecipes()->shouldBeLike($recipeList);
    }
}
