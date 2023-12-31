<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CpanelController extends Controller
{
    public function index()
    {
        return view('cpanel.index');

    }
}
