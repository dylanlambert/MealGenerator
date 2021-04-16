<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

use function view;

final class TestController
{
    public function react(): View
    {
        return view('React.test');
    }
}
