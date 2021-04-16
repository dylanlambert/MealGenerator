<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\Ingredient\IngredientsRetriever;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use function App\Http\checkUserFromToken;
use function response;

final class IngredientController
{
    /**
     * @OA\Get(
     *      security={{"bearer_token":{}}},
     *      path="/ingredients/all",
     *      description="Retrieve all ingredients",
     *      tags={"Ingredients"},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Return ingredients",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="ingredients",
     *                  type="array",
     *                  @OA\Items(type="object", ref="#/components/schemas/IngredientDto")
     *              )
     *          )
     *      ),
     *)
     */
    public function retrieve(Request $request, IngredientsRetriever $retriever): JsonResponse
    {
        $userId = checkUserFromToken($request);

        if ($userId === null) {
            return response()->json([], 401);
        }

        $ingredients = $retriever->retrieve()->getIngredients();

        return response()->json(['ingredients' => $ingredients]);
    }
}
