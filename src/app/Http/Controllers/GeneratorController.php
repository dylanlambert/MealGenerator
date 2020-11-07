<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Generator\Generator;
use App\Application\Generator\GeneratorRequest;
use Illuminate\Http\Request;

final class GeneratorController extends Controller
{
    public function generate(Request $request, Generator $generator)
    {
        $applicationRequest = new GeneratorRequest(
            (int) $request['numberOfRecipe'],
            (int) $request['preparationTime'] == 0 ? null : (int) $request['preparationTime'],
        );

        $applicationResponse = $generator->generate($applicationRequest);

        return view('Generator.view', ['recipes' => $applicationResponse->getRecipes()]);
    }
}
