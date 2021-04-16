<?php

declare(strict_types=1);

namespace App\Http {

    use App\Domain\Entities\User;
    use App\Domain\Utils\Id\Id;
    use App\Domain\Utils\Id\IdFactory;
    use App\Infrastructure\Utils\UserUtil;
    use App\Infrastructure\Utils\Uuid;
    use App\Token;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use function app;
    use DateTimeImmutable;
    use DateInterval;
    use function redirect;
    use function session;

    function createAuthToken(Id $idUser): string
    {
        $idFactory = app(IdFactory::class);

        $token = $idFactory->generateId();

        $model = new Token();
        $model->id = $idUser->toString();
        $model->token = $token->toString();
        $model->start_validity_date = (new DateTimeImmutable())->format('Y-m-d H:i:s');
        $model->save();

        return $token->toString();
    }

    function checkUserFromToken(Request $request): ?Id
    {
        if ($request->bearerToken() === null) {
            return null;
        }

        $tokenModel = Token::find($request->bearerToken());

        if ($tokenModel === null) {
            return null;
        }

        $startValidityDate = DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $tokenModel->start_validity_date);
        $ttl = new DateInterval('P3D');

        if (!$startValidityDate) {
            return null;
        }

        $expirationDate = $startValidityDate->add($ttl);
        $today = new DateTimeImmutable();

        if ($today > $expirationDate) {
            return null;
        }

        return Uuid::fromString($tokenModel->id);
    }

    /**
     * @template T
     * @param callable(User):T $action
     * @return T | RedirectResponse
     */
    function verifierUser(Request $request, callable $action)
    {
        $email = $request->session()->get('adresseEmail');
        $password = $request->session()->get('motDePasse');

        if ($email === null || $password === null) {
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

    function setUserSession(Request $request): void
    {
        session(['adresseEmail' => $request['adresseEmail']]);
        session(['motDePasse' => $request['password']]);
    }
}

namespace App\Utils {
    /**
     * @template Item
     * @phpstan-param array<mixed, Item> $array
     * @phpstan-param callable(Item): bool $itemMatches
     * @phpstan-return Item|null
     * @param array $array
     */
    function array_find(array $array, callable $itemMatches): mixed
    {
        $key = array_find_key($array, $itemMatches);

        if ($key === null) {
            return null;
        }

        return $array[$key];
    }

    /**
     * @template Key
     * @template Item
     * @phpstan-param array<Key, Item> $array
     * @phpstan-param callable(Item): bool $itemMatches
     * @phpstan-return Key|null
     * @param array $array
     */
    function array_find_key(array $array, callable $itemMatches): mixed
    {
        foreach ($array as $key => $item) {
            if ($itemMatches($item)) {
                return $key;
            }
        }

        return null;
    }
}
