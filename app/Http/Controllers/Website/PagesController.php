<?php

namespace App\Http\Controllers\Website;

use App\Mail\ContactUsForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Mail;
use App;

use App\Models\{
    Slider, News, Pages, Node
};

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
        $pagesModel = new Pages;
        $sliderModel = new Slider;
        $newsModel = new News;
        $locale = App::getLocale();
        if($locale == 'ar') {
            $data['pageTitle'] = 'جرارات زراعية , معدات , قطع غيار اصلية و خدمة مؤهلة';
            $data['pageDescription'] = 'جرارات هو اول سوق إليكترونى للجرارات الزراعية و المعدات وقطع الغيار';
        } else {
            $data['pageTitle'] = 'Agricultural tractors, equipment, genuine spare parts and service';
            $data['pageDescription'] = 'GARARAT –the first e-hypermarket for agricultural tractors, equipment and spare parts!';
        }
        $data['home'] = $pagesModel->getHomePage();
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
        $nodesModel = new Node;
        $query = $request->query('q');
        $locale = App::getLocale();

        if ($locale == 'ar') {
            $data['pageTitle'] = $query . ' :البحث عن نتائج';
        } else {
            $data['pageTitle'] = 'Search results for: ' . $query;
        }
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendContactsMail(Request $request)
    {
        $checkCode = 'g29853qg-(*&H@#O(*&FH0908hj2dc89hncole9r8whcd';

        if ($checkCode == $request->checkCode) {
            Mail::to(config('mail.to.sales'))->send(new ContactUsForm($request));
        }

        return redirect()->back();
    }
}
