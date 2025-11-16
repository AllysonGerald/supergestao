<?php

declare(strict_types=1);

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;

class SobreController extends Controller
{
    public function sobre()
    {
        return view('site.sobre');
    }
}
