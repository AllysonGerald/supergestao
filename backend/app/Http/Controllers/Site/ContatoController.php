<?php

declare(strict_types=1);

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;

class ContatoController extends Controller
{
    public function contato()
    {
        return view('site.contato');
    }
}
