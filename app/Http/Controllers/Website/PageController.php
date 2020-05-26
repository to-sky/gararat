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

use App\Models\{Slide, News, Page};

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
            'news' => News::latest()->take(4)->get()
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
        $offices = [
            [
                'name' => 'Cairo branch',
                'name_ar' => 'فرع القاهرة',
                'address' => '318 elshoufat- eltamoaa el Khames, Cairo, Egypt',
                'address_ar' => 'القاهرة - التجمع الخامس - الشويفات فيلا 318',
                'phones' => [
                    '01090912188' => 'director',
                    '01011805779' => 'commercial department',
                    '01016200599' => 'commercial department',
                    '01067153638' => 'commercial department'
                ],
                'email' => 'info@belmachinery.com',
                'lat' => '30.015417',
                'lng' => '31.411944'
            ],
            [
                'name' => 'Alexandria branch',
                'name_ar' => 'فرع الإسكندرية',
                'address' => 'Kabbari - in front of the Kabbari Traffic Unit - Alexandreia , Egypt',
                'address_ar' => 'محافظة الاسكندرية -  القبارى – أمام وحدة مرور القبارى',
                'phones' => [
                    '01063060781' => ''
                ],
                'email' => 'stock@belmachinery.com',
                'lat' => '31.169722',
                'lng' => '29.890972'
            ],
            [
                'name' => 'Luxor branch',
                'name_ar' => 'فرع الاقصر',
                'address' => 'EL Karnak in front of the police department of Water - Luxor City -Luxor Governorate - Egypt',
                'address_ar' => 'الكرنك أمام شرطة المسطحات المائية - – مدينة الاقصر - محافظة الاقصر',
                'phones' => [
                    '01099853330' => ''
                ],
                'email' => 'luxor@belmachinery.com',
                'lat' => '25.716111',
                'lng' => '32.650028'
            ]
        ];

        return view('website.pages.contacts', [
            'offices' => $offices
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

        return redirect()->back();
    }
}
