<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Equipment, Order, Page, Part, User};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Show list of all pages
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    /**
     * Edit homepage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('admin.pages.home', [
            'pageData' => Page::getHomePage()
        ]);
    }

    /**
     * Edit services page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function services()
    {
        $pagesModel = new Page;
        $getPage = $pagesModel->getPageByAlias('services');

        if($getPage === null) {
            $pagesModel->createDefaultPage('services', 'Services', 'Services');
        }

        $data['pageData'] = $pagesModel->getPageByAlias('services');
        $data['title'] = 'Services';

        return view('admin.pages.contacts', $data);
    }

    /**
     * Edit contacts page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts()
    {
        $pagesModel = new Page;
        $getPage = $pagesModel->getPageByAlias('contacts');

        if($getPage === null) {
            $pagesModel->createDefaultPage('contacts', 'Contacts', 'Contacts');
        }

        $data['pageData'] = $pagesModel->getPageByAlias('contacts');
        $data['title'] = 'Contacts';

        return view('admin.pages.contacts', $data);
    }

    /**
     * Edit parts or equipment page
     *
     * @param $catalog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function catalog($catalog)
    {
        $pagesModel = new Page;
        $getPage = $pagesModel->getPageByAlias($catalog);

        if($getPage === null) {
            $pagesModel->createDefaultPage('services', 'Services', 'Services');
        }

        $data['pageData'] = $pagesModel->getPageByAlias($catalog);
        $data['title'] = ucfirst($catalog);

        return view('admin.pages.catalog', $data);
    }

    /**
     * Admin dashboard main page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.dashboard.index', [
            'parts' => Part::all(),
            'equipment' => Equipment::all(),
            'orders' => Order::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Admin search page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminSearch(Request $request)
    {
        return view('admin.dashboard.search', [
            'parts' => Part::where('name', 'like', '%'.$request->q.'%')->paginate()
        ]);
    }
}
