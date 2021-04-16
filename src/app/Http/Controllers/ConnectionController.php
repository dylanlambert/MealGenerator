<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function view;
use function redirect;
use function session;

final class ConnectionController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showConnection(Request $request): View
    {
        return view('connection');
    }

    public function connection(Request $request): RedirectResponse
    {
        $user = $this->userRepository->connection($request['adresseEmail'], $request['password']);

        if ($user === null) {
            return redirect('/connection');
        }

        session(['adresseEmail' => $request['adresseEmail']]);
        session(['motDePasse' => $request['password']]);

        return redirect('/');
    }

    public function deconnection(Request $request): RedirectResponse
    {
        session(['adresseEmail' => null]);
        session(['motDePasse' => null]);

        return redirect('/connection');
    }
}
