<?php

namespace spec\App\Application\Recipe;

use App\Application\Recipe\Dto\RecipeDto;
use App\Application\Recipe\RecipeRetrieverRequest;
use App\Domain\Entities\Recipe;
use App\Domain\Repositories\RecipeRepository;
use App\Domain\Utils\StringId;
use PhpSpec\ObjectBehavior;

class RecipeRetrieverSpec extends ObjectBehavior
{
    function let(RecipeRepository $recipeRepository)
    {
        $this->beConstructedWith($recipeRepository);
    }

    function it_retrieves_recipe(RecipeRepository $recipeRepository)
    {
        $request = new RecipeRetrieverRequest(new StringId('recipe-id'));

        $recipeEntity = new Recipe(
            $request->getId(),
            'Recipe Name',
            600
        );

        $recipeRepository->find($request->getId())->shouldBeCalled()->willReturn($recipeEntity);

        $recipeDto = new RecipeDto(
            'Recipe Name',
            '10m'
        );

        $this->retrieve($request)->getRecipe()->shouldBeLike($recipeDto);
    }
}
