<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.slides.index', [
            'slides' => Slide::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Slide::create($request->all());

        return redirect()->route('admin.slides.index');
    }

    /**
     * @param Slide $slide
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Slide $slide
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(Request $request, Slide $slide)
    {
        $slide->update($request->all());

        return redirect()->route('admin.slides.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slide $slide
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();

        return redirect()->back();
    }
}