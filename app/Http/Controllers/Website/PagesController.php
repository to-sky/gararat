<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Helpers;

class PagesController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    public function homePage()
    {
        $helpers = new Helpers;

        $data['pageTitle'] = 'Home';
        $data['pageDescription'] = 'Description';

        return view('website.home', $data);
    }
    //======================================================================
    // API
    //======================================================================

}
