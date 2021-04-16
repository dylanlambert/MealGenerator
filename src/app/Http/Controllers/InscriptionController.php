<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Application\User\Inscription;
use App\Application\User\InscriptionRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function App\Http\setUserSession;
use function redirect;
use function view;

final class InscriptionController
{
    public function getInscription(Request $request): object
    {
        $email = $request->session()->get('adresseEmail');

        if ($email !== null) {
            return redirect('/');
        }

        return view('inscription');
    }

    public function inscription(Request $request, Inscription $inscription): RedirectResponse
    {
        $applicationRequest = new InscriptionRequest(
            $request['adresseEmail'],
            $request['password'],
            $request['nom'],
            $request['prenom'],
        );

        $applicationResponse = $inscription->inscrire($applicationRequest);

        if (!$applicationResponse->isInscrit()) {
            return redirect('/inscription');
        }

        setUserSession($request);
        return redirect('/');
    }
}
