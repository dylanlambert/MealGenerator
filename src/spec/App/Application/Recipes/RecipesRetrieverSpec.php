<?php

namespace spec\App\Application\Recipes;

use App\Application\Recipe\Dto\QuantifiedIngredientDto;
use App\Application\Recipe\Dto\OldRecipeDto;
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
                        new Ingredient(new StringId('ingredient-id-1'), 'ingredientName')
                    ),
                ]
            ),
                'process',
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
                        new Ingredient(new StringId('ingredient-id-1'), 'ingredientName')
                    ),
                ]
            ),
                'process',
            ),
        );

        $recipeRepository->get()->shouldBeCalled()->willReturn($recipeList);

        $dtos = [
            new OldRecipeDto(
                'recipe-id-1',
                'Recipe 1',
                new PreparationTime(600),
                [
                    new QuantifiedIngredientDto('ingredient-id', 'ingredientName', '100g', 100, 'gramme'),
                    new QuantifiedIngredientDto('ingredient-id-1', 'ingredientName', '100g', 100, 'gramme'),
                ],
                '/recipe/recipe-id-1',
                'process',
            ),
            new OldRecipeDto(
                'recipe-id-2',
                'Recipe 2',
                new PreparationTime(3600),
                [
                    new QuantifiedIngredientDto('ingredient-id', 'ingredientName', '100g', 100, 'gramme'),
                    new QuantifiedIngredientDto('ingredient-id-1', 'ingredientName', '100g', 100, 'gramme'),
                ],
                '/recipe/recipe-id-2',
                'process',
            )
        ];

        $this->oldRetrieve($request)->getRecipes()->shouldBeLike($dtos);
    }
}
