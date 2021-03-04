<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Repositories\UserRepository;
use Illuminate\Http\Request;

use function App\Http\verifierUser;

final class ConnectionController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showConnection(Request $request)
    {
        return view('connection');
    }

    public function connection(Request $request)
    {
        $user = $this->userRepository->connection($request['adresseEmail'], $request['password']);

        if($user === null) {
            return redirect('/connection');
        }

        session(['adresseEmail' => $request['adresseEmail']]);
        session(['motDePasse' => $request['password']]);

        return redirect('/');
    }

    public function deconnection(Request $request)
    {
        session(['adresseEmail' => null]);
        session(['motDePasse' => null]);

        return redirect('/connection');
    }
}
