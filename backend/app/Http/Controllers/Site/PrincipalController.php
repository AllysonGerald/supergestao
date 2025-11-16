<?php

declare(strict_types=1);

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;

class PrincipalController extends Controller
{
    public function principal()
    {
        return view('site.principal');
    }
}
