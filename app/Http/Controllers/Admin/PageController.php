<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PageRequest;
use App\Http\Requests\SearchRequest;
use App\Models\{Equipment, Order, Page, Part, Subscriber};
use App\Services\ProductService;
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
        return view('admin.pages.index', [
            'pages' => Page::orderBy('name')->get()
        ]);
    }

    /**
     * Show form for edit page
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update page
     *
     * @param PageRequest $request
     * @param Page $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());

        return redirect()->route('admin.pages.index');
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
            'subscribers' => Subscriber::active()->get()
        ]);
    }

    /**
     * Admin search page
     *
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        return view('admin.dashboard.search', [
            'products' => ProductService::searchProduct($request->q)->paginate()
        ]);
    }
}
