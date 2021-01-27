<?php

namespace App\Http\Controllers\Website;

use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\SearchRequest;
use App\Mail\ApplyFundingForm;
use App\Mail\ContactUsForm;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Session;
use Mail;
use App;

use App\Models\{Office, Slide, Post, Page};

class PageController extends Controller
{
    /**
     * Show "Home" page
     *
     * @return Factory|View
     */
    public function home()
    {
        return view('website.pages.home', [
            'page' => Page::getHomepage(),
            'slides' => Slide::all(),
            'postTypes' => Post::getPublishedAndGrouped()->map(function ($item) {
                return $item->sortByDesc('created_at')->take(3);
            })->sortKeys(),
        ]);
    }

    /**
     * Get dynamic page
     *
     * @param string $slug
     * @return Factory|View|string
     */
    public function dynamicPage(string $slug)
    {
        return view('website.pages.dynamic-page', [
            'page' => Page::whereSlug($slug)->firstOrFail()
        ]);
    }

    /**
     * Show "Contacts" page
     *
     * @return Factory|View
     */
    public function contacts()
    {
        return view('website.pages.contacts', [
            'offices' => Office::all()
        ]);
    }

    /**
     * Search page result
     *
     * @param SearchRequest $request
     * @return Factory|View
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
     * @return RedirectResponse
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
     * @return RedirectResponse
     */
    public function contactUs(ContactUsRequest $request)
    {
        Mail::to(config('mail.to.sales'))->send(new ContactUsForm($request));

        session()->flash('success', __('Your message has been sent.'));

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function applyFunding(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        Mail::to(config('mail.to.sales'))->send(new ApplyFundingForm($request));

        session()->flash('success', __('Your message has been sent.'));

        return redirect()->back();
    }
}
