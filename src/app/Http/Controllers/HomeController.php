<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Entities\User;
use Illuminate\Http\Request;

use function App\Http\verifierUser;

final class HomeController extends Controller
{
    public function get(Request $request)
    {
        return verifierUser($request, function(User $user){
            return view('home.home');
        });
    }
}
