<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $data['pageDescription'] = 'Description';
        $data['slides'] = $sliderModel->getAllSlides();
        $data['news'] = $newsModel->getLimitedNews(4);

        return view('website.home', $data);
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

    public function singleNewsPage($nw_id)
    {
        $newsModel = new News;
        $getNews = $newsModel->getNewsItemById($nw_id);
        $data['pageTitle'] = $getNews->nw_name;
        $data['pageDescription'] = $getNews->nw_description;
        $data['news'] = $getNews;
        return view('website.news.single', $data);
    }

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

}
