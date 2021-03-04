<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Historic\HistoricRegisterer;
use App\Application\Historic\HistoricRegistererRequest;
use App\Application\Historic\HistoricRetriever;
use App\Application\Historic\HistoricRetrieverRequest;
use App\Domain\Entities\User;
use App\Infrastructure\Utils\Uuid;
use Illuminate\Http\Request;

use function App\Http\verifierUser;

final class HistoricController
{
    public function get(Request $request, HistoricRetriever $retriever)
    {
        return verifierUser($request, function (User $user) use ($request, $retriever) {
            $applicationRequest = new HistoricRetrieverRequest(Uuid::fromString($request['id']));
            $applicationResponse = $retriever->retrieve($applicationRequest);
            return view('Generator.view',
                        [
                            'name' => $applicationResponse->getName(),
                            'recipes' => $applicationResponse->getRecipesDto(),
                            'ingredients' => $applicationResponse->getIngredients()
                        ]
            );
        });
    }

    public function save(Request $request, HistoricRegisterer $registerer)
    {
        return verifierUser($request, function(User $user) use ($request, $registerer) {
            $applicationRequest = new HistoricRegistererRequest(
                $request['name'],
                array_map(fn(string $id) => Uuid::fromString($id), $request['recipesId']),
            );

            $applicationResponse = $registerer->register($applicationRequest);

            if(!$applicationResponse) {
                return response('', 400);
            }

            return response('', 200);
        });
    }
}
