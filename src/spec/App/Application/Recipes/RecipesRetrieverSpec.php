<?php

namespace spec\App\Application\Recipes;

use App\Application\Recipe\Dto\QuantifiedIngredientDto;
use App\Application\Recipe\Dto\RecipeDto;
use App\Application\Recipes\RecipesRetriever;
use App\Application\Recipes\RecipesRetrieverRequest;
use App\Domain\Entities\Ingredient;
use App\Domain\Entities\QuantifiedIngredient;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Entities\RecipeList;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\Measurement\Gramme;
use App\Domain\Utils\PreparationTime\PreparationTime;
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
                new PreparationTime(600),
                new QuantifiedIngredientList(
                ...[
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            )
            ),
            new Recipe(
                new StringId('recipe-id-2'),
                'Recipe 2',
                new PreparationTime(3600),
                new QuantifiedIngredientList(
                ...[
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                    new QuantifiedIngredient(
                        new Gramme('100'),
                        new Ingredient(new StringId('ingredient-id'), 'ingredientName')
                    ),
                ]
            )
            ),
        );

        $recipeRepository->get()->shouldBeCalled()->willReturn($recipeList);

        $dtos = [
            new RecipeDto(
                'recipe-id-1',
                'Recipe 1',
                new PreparationTime(600),
                [
                    new QuantifiedIngredientDto('ingredient-id', 'ingredientName', '100g', 100),
                    new QuantifiedIngredientDto('ingredient-id', 'ingredientName', '100g', 100),
                ],
                '/recipe/recipe-id-1',
            ),
            new RecipeDto(
                'recipe-id-2',
                'Recipe 2',
                new PreparationTime(3600),
                [
                    new QuantifiedIngredientDto('ingredient-id', 'ingredientName', '100g', 100),
                    new QuantifiedIngredientDto('ingredient-id', 'ingredientName', '100g', 100),
                ],
                '/recipe/recipe-id-2',
            )
        ];

        $this->retrieve($request)->getRecipes()->shouldBeLike($dtos);
    }
}
