<?php

namespace App\Http\Controllers;

use App\Application\Ingredient\IngredientsRetriever;
use App\Application\Recipe\RecipeRegisterer;
use App\Application\Recipe\RecipeRegistererRequest;
use App\Application\Recipe\RecipeRetriever;
use App\Application\Recipe\RecipeRetrieverRequest;
use App\Application\Recipe\RecipeUpdater;
use App\Application\Recipe\RecipeUpdaterRequest;
use App\Application\Recipes\ApiRecipesRetriever;
use App\Application\Recipes\RecipesRetriever;
use App\Application\Recipes\RecipesRetrieverRequest;
use App\Domain\Entities\User;
use App\Domain\Utils\Id\StringId;
use Illuminate\Http\Request;

use function App\Http\checkUserFromToken;
use function App\Http\verifierUser;

class RecipeController extends Controller
{
    /**
     * @OA\Get(
     *      security={{"bearer_token":{}}},
     *      path="/recipes/all",
     *      description="Retrieve all recepies",
     *      tags={"Recipies"},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Return recipes",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="recipes",
     *                  type="array",
     *                  @OA\Items(type="object", ref="#/components/schemas/RecipeDto")
     *              )
     *          )
     *      ),
     *)
     */
    public function retrieve(Request $request, ApiRecipesRetriever $recipeRetriever)
    {
        $userId = checkUserFromToken($request);

        if($userId === null) {
            return response()->json([], 401);
        }

        $recipes = $recipeRetriever->retrieve(new RecipesRetrieverRequest(null))->getRecipes();

        if($recipes === null) {
            return response('', 400);
        }

        return response()->json(["recipes" => $recipes]);
    }

    public function get(Request $request, RecipeRetriever $recipeRetriever)
    {
      return verifierUser($request, function(User $user) use ($request, $recipeRetriever) {
          $applicationRequest = new RecipeRetrieverRequest(new StringId($request['recipeId']));
          $applicationResponse = $recipeRetriever->retrieve($applicationRequest);

          if($applicationResponse->getRecipe() === null) {
              return response()->json([], 400);
          }

          return view('Recipe.recipe', ['recipe' => $applicationResponse->getRecipe()]);
      });
    }

    public function register(Request $request, RecipeRegisterer $recipeRegisterer)
    {
       return verifierUser($request, function(User $user) use ($request, $recipeRegisterer) {
           $applicationRequest = new RecipeRegistererRequest($request['name'], $request['preparationTime']);
           $applicationResponse = $recipeRegisterer->register($applicationRequest);
       });
    }

    public function getList(Request $request, RecipesRetriever $recipesRetriever)
    {
        return verifierUser($request, function(User $user) use ($request, $recipesRetriever) {
            $applicationRequest = new RecipesRetrieverRequest($request['preparationTime'] ?? null);
            $applicationResponse = $recipesRetriever->oldRetrieve($applicationRequest);

            if($applicationResponse->getRecipes() === null) {
                response('', 400);
            }

            return view('Recipe.recipeList', ['recipes' => $applicationResponse->getRecipes()]);
        });
    }

    public function updateGet(Request $request, RecipeRetriever $recipeRetriever, IngredientsRetriever $ingredientsRetriever)
    {
        return verifierUser($request, function(User $user) use ($request, $recipeRetriever, $ingredientsRetriever){
            $applicationRequest = new RecipeRetrieverRequest(new StringId($request['recipeId']));
            $applicationResponse = $recipeRetriever->retrieve($applicationRequest);
            if($applicationResponse->getRecipe() === null) {
                return response()->json([], 400);
            }

            $ingredients = $ingredientsRetriever->retrieve()->getIngredients();

            return view('Recipe.update', ['recipe' => $applicationResponse->getRecipe(), 'ingredients' => $ingredients]);
        });
    }

    public function updatePost(Request $request, RecipeUpdater $updater)
    {
        return verifierUser($request, function(User $user) use ($request, $updater){
            $applicationRequest = new RecipeUpdaterRequest(
                $request['recipeId'],
                $request['name'],
                $request['ingredient'] ?? [],
                $request['preparationTime'],
                $request['recipe'] === null ? '' : $request['recipe'],
            );

            $applicationResponse = $updater->update($applicationRequest);

            if(!$applicationResponse->isRegistered()) {
                response('', 400);
            }
            $url = '/recipe/' . $request['recipeId'];
            redirect()->to($url)->send();
        });
    }
}
