<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PageRequest;
use App\Models\Page;
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
            'pages' => Page::orderBy('name')->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        Page::create($request->all());

        return redirect()->route('admin.pages.index');
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
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->back();
    }
}
