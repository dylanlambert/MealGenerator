<?php

namespace spec\App\Application\Historic;

use App\Application\Historic\HistoricRetriever;
use App\Application\Historic\HistoricRetrieverRequest;
use App\Application\Historic\HistoricRetrieverResponse;
use App\Application\Recipe\Dto\OldRecipeDto;
use App\Domain\Entities\Historic;
use App\Domain\Entities\QuantifiedIngredientList;
use App\Domain\Entities\Recipe;
use App\Domain\Repositories\HistoricRepository;
use App\Domain\Utils\Id\StringId;
use App\Domain\Utils\PreparationTime\PreparationTime;
use PhpSpec\ObjectBehavior;

class HistoricRetrieverSpec extends ObjectBehavior
{
    function let(HistoricRepository $historicRepository)
    {
        $this->beConstructedWith($historicRepository);
    }

    function it_retrieves_historic(HistoricRepository $historicRepository)
    {
        $historicId = new StringId('historic-id');
        $request = new HistoricRetrieverRequest($historicId);

        $historic = new Historic(
            'historic name',
            [
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
            ]
        );


        $historicRepository->find($historicId)->shouldBeCalled()->willReturn($historic);

        $response = new HistoricRetrieverResponse(
            'historic name',
            [
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
            ]
        );

        $this->retrieve($request)->shouldBeLike($response);
    }
}
