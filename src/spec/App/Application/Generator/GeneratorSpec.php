<?php

namespace spec\App\Application\Generator;

use App\Application\Generator\Generator;
use App\Application\Generator\GeneratorRequest;
use App\Application\Recipe\Dto\RecipeDto;
use App\Domain\Entities\MeasuredIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Entities\RecipeList;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\PreparationTime\PreparationTime;
use PhpSpec\ObjectBehavior;

class GeneratorSpec extends ObjectBehavior
{
    function let(RecipeRepository $recipeRepository)
    {
        $this->beConstructedWith($recipeRepository);
    }

    function it_generates_with_preparation_time(RecipeRepository $recipeRepository)
    {
        $request = new GeneratorRequest(2, 600);

        $recipeList = new RecipeList(
            new Recipe(
                new StringId('recipe-1'),
                'Recette 1',
                new PreparationTime(600),
                new MeasuredIngredientList(),
            ),
            new Recipe(
                new StringId('recipe-2'),
                'Recette 2',
                new PreparationTime(600),
                new MeasuredIngredientList(),
            ),
            new Recipe(
                new StringId('recipe-3'),
                'Recette 3',
                new PreparationTime(600),
                new MeasuredIngredientList(),
            ),
            new Recipe(
                new StringId('recipe-4'),
                'Recette 4',
                new PreparationTime(3600),
                new MeasuredIngredientList(),
            ),
        );

        $recipeRepository->get()->shouldBeCalled()->willReturn($recipeList);

        $recipes = [
            new RecipeDto(
                'Recette 1',
                '10 minutes',
                [],
                '/recipe/recipe-1'
            ),
            new RecipeDto(
                'Recette 2',
                '10 minutes',
                [],
                '/recipe/recipe-2'
            ),
        ];

        $this->generate($request)->getRecipes()->shouldHaveCount(2);
    }

    function it_generates_without_preparation_time(RecipeRepository $recipeRepository)
    {
        $request = new GeneratorRequest(2, null);

        $recipeList = new RecipeList(
            new Recipe(
                new StringId('recipe-1'),
                'Recette 1',
                new PreparationTime(600),
                new MeasuredIngredientList(),
            ),
            new Recipe(
                new StringId('recipe-2'),
                'Recette 2',
                new PreparationTime(600),
                new MeasuredIngredientList(),
            ),
            new Recipe(
                new StringId('recipe-3'),
                'Recette 3',
                new PreparationTime(600),
                new MeasuredIngredientList(),
            ),
            new Recipe(
                new StringId('recipe-4'),
                'Recette 4',
                new PreparationTime(3600),
                new MeasuredIngredientList(),
            ),
        );

        $recipeRepository->get()->shouldBeCalled()->willReturn($recipeList);

//        $recipes = [
//            new RecipeDto(
//                'Recette 1',
//                '10 minutes',
//                [],
//                '/recipe/recipe-1'
//            ),
//            new RecipeDto(
//                'Recette 2',
//                '10 minutes',
//                [],
//                '/recipe/recipe-2'
//            ),
//            new RecipeDto(
//                'Recette 3',
//                '10 minutes',
//                [],
//                '/recipe/recipe-3'
//            ),
//        ];

        // TODO amélio le test pour vérifier le type et la préparation time

        $this->generate($request)->getRecipes()->shouldHaveCount(2);
    }
}
