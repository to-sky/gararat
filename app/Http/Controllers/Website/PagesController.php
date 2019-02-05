<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    public function homePage()
    {
        return view('home');
    }
    //======================================================================
    // API
    //======================================================================

}
