<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Helpers;
use \App\Models\Slider;

class PagesController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homePage()
    {
        $helpers = new Helpers;
        $sliderModel = new Slider;

        $data['pageTitle'] = 'Home';
        $data['pageDescription'] = 'Description';
        $data['slides'] = $sliderModel->getAllSlides();

        return view('website.home', $data);
    }
    //======================================================================
    // API
    //======================================================================

}
