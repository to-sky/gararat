<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Slider;
use \App\Models\News;
use \App\Models\Pages;

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
    public function securedSlidesPage()
    {
        $sliderModel = new Slider;
        $data['pageTitle'] = 'Slider';
        $data['slides'] = $sliderModel->getAllSlides();
        return view('secured.slider.list', $data);
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedAddSlidePage()
    {
        $data['pageTitle'] = 'Add New Slide';

        return view('secured.slider.add', $data);
    }

    /**
     * @param $sl_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function securedRemoveSlide($sl_id)
    {
        $sliderModel = new Slider;
        $sliderModel->removeSlide($sl_id);
        return redirect()->back();
    }
    ########################################################################
    ### News
    ########################################################################
    public function securedNewsListPage()
    {
        $newsModel = new News;

        $data['pageTitle'] = 'News';
        $data['news'] = $newsModel->getAllNews(100);

        return view('secured.news.list', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedAddNewNewsItem()
    {
        $data['pageTitle'] = 'Add News Item';

        return view('secured.news.add', $data);
    }

    /**
     * @param $nw_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedUpdateNewsItem($nw_id)
    {
        $newsModel = new News;
        $getNews = $newsModel->getNewsItemById($nw_id);
        $data['pageTitle'] = $getNews->nw_name;
        $data['news'] = $getNews;
        return view('secured.news.edit', $data);
    }

    /**
     * @param $nw_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function securedRemoveNewsItem($nw_id)
    {
        $newsModel = new News;
        $newsModel->removeNewsItem($nw_id);
        return redirect()->back();
    }
    ########################################################################
    ### Pages
    ########################################################################

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
        return redirect()->route('securedSlidesPage');
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
        return redirect()->route('securedNewsListPage');
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
        return redirect()->route('securedNewsListPage');
    }
    ########################################################################
    ### Pages
    ########################################################################

}