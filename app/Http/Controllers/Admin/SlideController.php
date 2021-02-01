<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.slides.index', [
            'slides' => Slide::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Slide::create($request->all());

        return redirect()->route('admin.slides.index');
    }

    /**
     * @param Slide $slide
     * @return Factory|View
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
     * @return Factory|View
     */
    public function update(Request $request, Slide $slide)
    {
        $slide->update($request->all());

        return redirect()->to($request->previous_page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Slide $slide
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();

        return back();
    }
}
