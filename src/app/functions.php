<?php

declare(strict_types=1);

namespace App\Http {

    use App\Domain\Utils\Id\Id;
    use App\Domain\Utils\Id\IdFactory;
    use App\Infrastructure\Utils\UserUtil;
    use App\Token;
    use Illuminate\Http\Request;

    function createConnectionToken(Id $idUser): string
    {
        $idFactory = app(IdFactory::class);

        $token = $idFactory->generateId();

        $model = new Token();
        $model->id = (string) $idUser;
        $model->token = (string) $token;
        $model->start_validity_date = (new \DateTimeImmutable())->format('Y-m-d H:i:s');
        $model->save();

        return (string) $token;
    }

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
