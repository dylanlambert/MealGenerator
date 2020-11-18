<?php

declare(strict_types=1);

namespace App\Http\Controllers;

final class TestController extends Controller
{
    public function react()
    {
        return view('React.test');
    }
}
