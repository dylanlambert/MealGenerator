<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Entities\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use function App\Http\verifierUser;
use function view;

final class HomeController
{
    /**
     * @return RedirectResponse|View
     */
    public function get(Request $request)
    {
        return verifierUser($request, function (User $user) {
            return view('home.home');
        });
    }
}
