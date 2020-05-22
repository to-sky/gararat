<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PageRequest;
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
