<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App;

use \App\Models\Helpers;
use \App\Models\Slider;
use \App\Models\News;
use \App\Models\Pages;
use \App\Models\Nodes;

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
        $newsModel = new News;

        $data['pageTitle'] = 'Home';
        $data['pageDescription'] = '';
        $data['slides'] = $sliderModel->getAllSlides();
        $data['news'] = $newsModel->getLimitedNews(4);

        return view('website.home', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function servicesPage()
    {
        $pagesModel = new Pages;
        $locale = App::getLocale();
        $getPage = $pagesModel->getPageByAlias('services');
        if($locale == 'ar') {
            $data['pageTitle'] = $getPage->pg_title_ar;
            $data['pageDescription'] = $getPage->pg_description_ar;
        } else {
            $data['pageTitle'] = $getPage->pg_title;
            $data['pageDescription'] = $getPage->pg_description;
        }
        $data['page'] = $getPage;

        return view('website.services', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactsPage()
    {
        $pagesModel = new Pages;
        $locale = App::getLocale();
        $getPage = $pagesModel->getPageByAlias('contacts');
        if($locale == 'ar') {
            $data['pageTitle'] = $getPage->pg_title_ar;
            $data['pageDescription'] = $getPage->pg_description_ar;
        } else {
            $data['pageTitle'] = $getPage->pg_title;
            $data['pageDescription'] = $getPage->pg_description;
        }
        $data['page'] = $getPage;

        return view('website.contacts', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newsPage()
    {
        $newsModel = new News;

        $data['pageTitle'] = 'News';
        $data['pageDescription'] = '';
        $data['news'] = $newsModel->getAllNews(40);

        return view('website.news.list', $data);
    }

    /**
     * @param $nw_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function singleNewsPage($nw_id)
    {
        $newsModel = new News;
        $locale = App::getLocale();
        $getNews = $newsModel->getNewsItemById($nw_id);
        if ($locale == 'ar') {
            $data['pageTitle'] = $getNews->nw_name_ar;
            $data['pageDescription'] = $getNews->nw_description_ar;
        } else {
            $data['pageTitle'] = $getNews->nw_name;
            $data['pageDescription'] = $getNews->nw_description;
        }
        $data['news'] = $getNews;
        return view('website.news.single', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchResults(Request $request)
    {
        $nodesModel = new Nodes;
        $query = $request->query('q');

        $data['pageTitle'] = 'Search results for: ' . $query;
        $data['searchRequest'] = $query;
        $data['products'] = $nodesModel->getNodesBySearchRequest($query);
        return view('website.search', $data);
    }
    //======================================================================
    // API
    //======================================================================
    /**
     * @param $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function langSwitcherPage($lang)
    {
        Session::put('locale', $lang);
        return redirect()->back();
    }
}
