<?php

namespace App\Http\Controllers;

use App\Application\Recipe\RecipeRegisterer;
use App\Application\Recipe\RecipeRegistererRequest;
use App\Application\Recipe\RecipeRetriever;
use App\Application\Recipe\RecipeRetrieverRequest;
use App\Domain\Utils\StringId;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function get(Request $request, RecipeRetriever $recipeRetriever)
    {
        $applicationRequest = new RecipeRetrieverRequest(new StringId($request['recipeId']));
        $applicationResponse = $recipeRetriever->retrieve($applicationRequest);

        if($applicationResponse->getRecipe() === null) {
            return response()->json([], 400);
        }


        return view('Recipe.recipe', ['recipe' => $applicationResponse->getRecipe()]);
    }

    public function register(Request $request, RecipeRegisterer $recipeRegisterer)
    {
        $applicationRequest = new RecipeRegistererRequest($request['name'], $request['preparationTime']);
        $applicationResponse = $recipeRegisterer->register($applicationRequest);
    }
}
