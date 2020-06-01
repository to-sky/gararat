<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\SearchRequest;
use App\Mail\ContactUsForm;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Session;
use Mail;
use App;

use App\Models\{Office, Slide, News, Page};

class PageController extends Controller
{
    /**
     * Show "Home" page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('website.pages.home', [
            'page' => Page::whereSlug(Page::HOME_PAGE_SLUG)->first(),
            'slides' => Slide::all(),
            'news' => News::latest()->take(3)->get()
        ]);
    }

    /**
     * Show "Services" page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function services()
    {
        return view('website.pages.services', [
            'page' => Page::whereSlug(Page::SERVICES_PAGE_SLUG)->first()
        ]);
    }

    /**
     * Show "Contacts" page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts()
    {
        return view('website.pages.contacts', [
            'offices' => Office::all()
        ]);
    }

    /**
     * Search products
     *
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        return view('website.pages.search', [
            'products' => ProductService::searchProduct($request->q)->paginate()
        ]);
    }

    /**
     * Change locale
     *
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function languageChange($locale)
    {
        Session::put('locale', $locale);

        return redirect()->back();
    }

    /**
     * Send ContactUs form
     *
     * @param ContactUsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactUs(ContactUsRequest $request)
    {
        Mail::to(config('mail.to.sales'))->send(new ContactUsForm($request));

        session()->flash('success', __('Your message has been sent.'));

        return redirect()->back();
    }
}
