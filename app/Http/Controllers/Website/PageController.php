<?php

namespace App\Http\Controllers\Website;

use App\Mail\ContactUsForm;
use App\Rules\GoogleRecaptcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Mail;
use App;

use App\Models\{Slider, News, Page};

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
            'home' => Page::getHomePage(),
            'slides' => Slider::orderBy('sl_order', 'ASC')->get(),
            'news' => News::take(4)->get()
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
            'page' => Page::getPageByAlias('services')
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
            'page' => Page::getPageByAlias('contacts')
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        // TODO: fix search
        $products = [];

        return view('website.pages.search', compact('products'));
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
     * Send ContactUs form with Google ReCaptcha validation
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactUs(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => ['required', new GoogleRecaptcha()]
        ]);

        Mail::to(config('mail.to.sales'))->send(new ContactUsForm($request));

        return redirect()->back();
    }
}
