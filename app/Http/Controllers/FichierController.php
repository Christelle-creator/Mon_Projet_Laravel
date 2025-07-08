<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FichierController extends Controller
{
    public function lire()
    {
        return view('front');
    }
}
