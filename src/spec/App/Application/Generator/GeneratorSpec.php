<?php

namespace spec\App\Application\Generator;

use App\Application\Generator\GeneratorRequest;
use App\Application\Recipe\Dto\OldRecipeDto;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Entities\RecipeList;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\PreparationTime\PreparationTime;
use PhpSpec\ObjectBehavior;

final class GeneratorSpec extends ObjectBehavior
{
    public function let(RecipeRepository $recipeRepository)
    {
        $this->beConstructedWith($recipeRepository);
    }

    public function it_generates_with_preparation_time(RecipeRepository $recipeRepository)
    {
        $request = new GeneratorRequest(2, 600);

        $recipeList = new RecipeList(
            new Recipe(
                new StringId('recipe-1'),
                'Recette 1',
                new PreparationTime(600),
                new QuantifiedIngredientList(),
                'process',
            ),
            new Recipe(
                new StringId('recipe-2'),
                'Recette 2',
                new PreparationTime(600),
                new QuantifiedIngredientList(),
                'process',
            ),
            new Recipe(
                new StringId('recipe-3'),
                'Recette 3',
                new PreparationTime(600),
                new QuantifiedIngredientList(),
                'process',
            ),
            new Recipe(
                new StringId('recipe-4'),
                'Recette 4',
                new PreparationTime(3600),
                new QuantifiedIngredientList(),
                'process',
            ),
        );

        $recipeRepository->get()->shouldBeCalled()->willReturn($recipeList);

        $recipes = [
            new OldRecipeDto(
                'recipe-1',
                'Recette 1',
                new PreparationTime(600),
                [],
                '/recipe/recipe-1',
                'process',
            ),
            new OldRecipeDto(
                'recipe-2',
                'Recette 2',
                new PreparationTime(600),
                [],
                '/recipe/recipe-2',
                'process',
            ),
        ];

        $this->generate($request)->getRecipes()->shouldHaveCount(2);
    }

    public function it_generates_without_preparation_time(RecipeRepository $recipeRepository)
    {
        $request = new GeneratorRequest(2, null);

        $recipeList = new RecipeList(
            new Recipe(
                new StringId('recipe-1'),
                'Recette 1',
                new PreparationTime(600),
                new QuantifiedIngredientList(),
                'process',
            ),
            new Recipe(
                new StringId('recipe-2'),
                'Recette 2',
                new PreparationTime(600),
                new QuantifiedIngredientList(),
                'process',
            ),
            new Recipe(
                new StringId('recipe-3'),
                'Recette 3',
                new PreparationTime(600),
                new QuantifiedIngredientList(),
                'process',
            ),
            new Recipe(
                new StringId('recipe-4'),
                'Recette 4',
                new PreparationTime(3600),
                new QuantifiedIngredientList(),
                'process',
            ),
        );

        $recipeRepository->get()->shouldBeCalled()->willReturn($recipeList);

        $this->generate($request)->getRecipes()->shouldHaveCount(2);
    }
}
