<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\{
    Slider, News, Page
};

class CommonController extends Controller
{
    //======================================================================
    // API
    //======================================================================
    ########################################################################
    ### Slider
    ########################################################################
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNewSlideAPI(Request $request)
    {
        $sliderModel = new Slider;
        $data = $request->all();
        $file = $request->file('slideImage');
        $sliderModel->saveNewSlide($data, $file);

        return redirect()->route('admin.slider.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSlideAPI(Request $request)
    {
        $sliderModel = new Slider;
        $data = $request->all();
        $file = $request->file('slideImage');
        $sliderModel->updateSlider($data, $file);
        return redirect()->route('admin.slider.index');
    }
    ########################################################################
    ### News
    ########################################################################
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNewNewsItemAPI(Request $request)
    {
        $newsModel = new News;
        $data = $request->all();
        $file = $request->file('newsImage');
        $newsModel->createNewsItem($data, $file);

        return redirect()->route('admin.news.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateNewsItemAPI(Request $request)
    {
        $newsModel = new News;
        $data = $request->all();
        $file = $request->file('newsImage');
        $newsModel->updateNewsItem($data, $file);

        return redirect()->route('admin.news.index');
    }
    ########################################################################
    ### Pages
    ########################################################################
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePageItemAPI(Request $request)
    {
        $pagesModel = new Page;
        $data = $request->all();
        $pagesModel->updateDefaultPage($data);

        return redirect()->route('admin.pages.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateHomePageItemAPI(Request $request)
    {
        $pagesModel = new Page;
        $data = $request->all();
        $pagesModel->updateHomePage($data);

        return redirect()->route('admin.pages.index');
    }
}
