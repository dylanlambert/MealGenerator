<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Generator\Generator;
use App\Application\Generator\GeneratorRequest;
use App\Domain\Entities\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function App\Http\verifierUser;
use function view;

final class GeneratorController
{
    /**
     * @return RedirectResponse|View
     */
    public function generate(Request $request, Generator $generator)
    {
        return verifierUser(
            $request,
            function (User $user) use ($request, $generator) {
                $applicationRequest = new GeneratorRequest(
                    (int)$request['numberOfRecipe'],
                    (int)$request['preparationTime'] == 0 ? null : (int)$request['preparationTime'],
                );

                $applicationResponse = $generator->generate($applicationRequest);

                return view(
                    'Generator.view',
                    [
                                'recipes' => $applicationResponse->getRecipes(),
                                'ingredients' => $applicationResponse->getIngredients()
                            ]
                );
            }
        );
    }
}
