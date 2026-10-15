<?php


namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;


class LibraryCardDesignerController extends Controller
{
    public function index()
    {
        return view('School.Pages.Designer.designer');
    }
}
