<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Slider;

class SecuredCommonController extends Controller
{
    //======================================================================
    // PAGE
    //======================================================================
    ########################################################################
    ### Slider
    ########################################################################
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedAddSlidePage()
    {
        $data['pageTitle'] = 'Add New Slide';

        return view('secured.slider.add', $data);
    }
    //======================================================================
    // API
    //======================================================================
    ########################################################################
    ### Slider
    ########################################################################
    public function saveNewSlideAPI(Request $request)
    {
        $sliderModel = new Slider;
        $data = $request->all();
        $file = $request->file('slideImage');
        dd($data);
    }
}
