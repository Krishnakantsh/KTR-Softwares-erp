<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryCardDesignerController extends Controller
{
    public function index()
    {
        return view('Frontend/Normal/Pages/Designer/designer');
    }
}
