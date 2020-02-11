<?php

namespace App\Http\Controllers\Secured;

use App\Http\Controllers\Controller;
use App\Models\Slider;

class SecuredSliderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('secured.slider.index', [
            'slides' => Slider::all()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('secured.slider.create');
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Slider $slider)
    {
        return view('secured.slider.edit', compact('slider'));
    }

    /**
     * @param Slider $slider
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Slider $slider)
    {
        $slider->delete();

        return redirect()->back();
    }

}