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
        $data['pageTitle'] = 'Home';
        $data['pageDescription'] = 'Description';

        return view('website.home', $data);
    }
    //======================================================================
    // API
    //======================================================================

}
