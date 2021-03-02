<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Historic\HistoricRegisterer;
use App\Application\Historic\HistoricRegistererRequest;
use App\Application\Historic\HistoricRetriever;
use App\Application\Historic\HistoricRetrieverRequest;
use App\Infrastructure\Utils\Uuid;
use Illuminate\Http\Request;

final class HistoricController
{
    public function get(Request $request, HistoricRetriever $retriever)
    {
        $applicationRequest = new HistoricRetrieverRequest(Uuid::fromString($request['id']));
        $applicationResponse = $retriever->retrieve($applicationRequest);
        return view('Generator.view',
                    [
                        'name' => $applicationResponse->getName(),
                        'recipes' => $applicationResponse->getRecipesDto(),
                        'ingredients' => $applicationResponse->getIngredients()
                    ]
        );
    }

    public function save(Request $request, HistoricRegisterer $registerer)
    {
        $applicationRequest = new HistoricRegistererRequest(
            $request['name'],
            array_map(fn(string $id) => Uuid::fromString($id), $request['recipesId']),
        );

        $applicationResponse = $registerer->register($applicationRequest);

        if(!$applicationResponse) {
            return response('', 400);
        }

        return response('', 200);
    }
}
