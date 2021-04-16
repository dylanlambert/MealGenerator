<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\User\Inscription;
use App\Application\User\InscriptionRequest;
use App\Application\User\UserRetriever;
use App\Application\User\UserRetrieverRequest;
use App\Infrastructure\Utils\Uuid;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

use function App\Http\createAuthToken;
use function response;

final class UserController
{
    /**
     * @OA\Post(
     *      path="/user/inscription",
     *      description="Register by email, password, user name, user firstname",
     *      tags={"Register"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass user informations",
     *          @OA\JsonContent(
     *              required={"userEmail","userPassword", "userName", "userFirstName"},
     *              @OA\Property(property="userEmail", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="userPassword", type="string", format="password", example="PassWord12345"),
     *              @OA\Property(property="userName", type="string", example="Lambert"),
     *              @OA\Property(property="userFirstName", type="string", example="Dylan"),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=400,
     *          description="Registration failure",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Email already use")
     *          )
     *      ),
     *
     *      @OA\Response(response=200, description="Registration complete"),
     * )
     */
    public function inscription(Request $request, Inscription $inscription): JsonResponse
    {
        $applicationRequest = new InscriptionRequest(
            $request['userEmail'],
            $request['userPassword'],
            $request['userName'],
            $request['userFirstName']
        );

        $applicationResponse = $inscription->inscrire($applicationRequest);

        if (!$applicationResponse->isInscrit()) {
            return response()->json(['error' => 'Email already in use'], 400);
        }

        return response()->json([], 201);
    }


    /**
     * @OA\Post(
     *      path="/user/connexion",
     *      description="Retrieve user by email, password",
     *      tags={"Connexion"},
     *
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass user credentials",
     *          @OA\JsonContent(
     *              required={"userEmail","userPassword"},
     *              @OA\Property(property="userEmail", type="string", format="email", example="user1@mail.com"),
     *              @OA\Property(property="userPassword", type="string", format="password", example="PassWord12345")
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Return connexion token, need to be placed on all request (in header bearer style)",
     *          @OA\Property(property="token", type="string", format="uuid"),
     *      ),
     *
     *      @OA\Response(
     *          response=400,
     *          description="User not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="user not found")
     *          )
     *      ),
     *)
     */
    public function connexion(Request $request, UserRetriever $retriever): JsonResponse
    {
        $applicationRequest = new UserRetrieverRequest(
            $request['userEmail'],
            $request['userPassword'],
        );

        $applicationResponse = $retriever->retrieve($applicationRequest);

        if ($applicationResponse->error() !== null) {
            return response()->json(['error' => $applicationResponse->error()], 400);
        }

        if ($applicationResponse->user() === null) {
            return response()->json(['error' => 'user not found'], 404);
        }

        $token = createAuthToken(Uuid::fromString($applicationResponse->user()->userId()));

        return response()->json($token);
    }
}
