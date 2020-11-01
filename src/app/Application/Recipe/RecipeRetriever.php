<?php

declare(strict_types=1);

namespace App\Application\Recipe;

use App\Application\Recipe\Dto\RecipeDto;
use App\Domain\Exceptions\NotFoundException;
use App\Domain\Repositories\RecipeRepository;

final class RecipeRetriever
{
    private RecipeRepository $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function retrieve(RecipeRetrieverRequest $request): RecipeRetrieverResponse
    {
        try {
            $recipe = $this->recipeRepository->find($request->getId());

            $preparationTime = $recipe->getPreparationTime() / 60 . 'm';
            $recipeDto = new RecipeDto($recipe->getName(), $preparationTime);

            return new RecipeRetrieverResponse($recipeDto);

        } catch (NotFoundException $exception) {
            return new RecipeRetrieverResponse(null);
        }
    }
}
