<?php

declare(strict_types=1);

namespace App\Http {

    use App\Infrastructure\Utils\UserUtil;
    use Illuminate\Http\Request;

    function verifierUser(Request $request, callable $action)
    {
        $email = $request->session()->get('adresseEmail');
        $password = $request->session()->get('motDePasse');

        if($email === null || $password === null) {
            return redirect('/connection');
        }

        $user = app(UserUtil::class)->connect(
            $email,
            $password
        );

        if ($user === null) {
            return redirect('/connection');
        }

        return $action($user);
    }

    function setUserSession(Request $request) {
        session(['adresseEmail' => $request['adresseEmail']]);
        session(['motDePasse' => $request['password']]);
    }
}
