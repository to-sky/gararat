<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartRequest;
use App\Models\{Catalog, Equipment, Part};

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.parts.index', [
            'parts' => Part::orderByDesc('id')->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->generateParams();

        return view('admin.parts.create');
    }

    /**
     * Get repeater item view
     * number - this is position of item
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRepeaterItem()
    {
        $this->generateParams();

        return view('admin.parts.includes._repeater-item', [
            'number' => request('number') ?? 1,
            'item' => Part::find(request('part_id'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PartRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PartRequest $request)
    {
        Part::create($request->all());

        return redirect()->route('admin.parts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function edit(Part $part)
    {
        $this->generateParams();

        return view('admin.parts.edit', compact('part'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PartRequest $request
     * @param  \App\Models\Part $part
     * @return \Illuminate\Http\Response
     */
    public function update(PartRequest $request, Part $part)
    {
        $part->update($request->all());

        return redirect()->route('admin.parts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Part $part
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Part $part)
    {
        $part->delete();

        return redirect()->route('admin.parts.index');
    }

    /**
     * Share the same variables for different views
     */
    public function generateParams()
    {
        $equipment =  Equipment::all();
        $catalogs = Catalog::all();

        view()->share('equipment', $equipment);
        view()->share('catalogs', $catalogs);
    }
}
