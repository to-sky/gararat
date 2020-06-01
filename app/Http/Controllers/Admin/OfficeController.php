<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeRequest;
use App\Models\Office;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.offices.index', [
            'offices' => Office::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OfficeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeRequest $request)
    {
        Office::create($request->all());

        return redirect()->route('admin.offices.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OfficeRequest $request
     * @param  \App\Models\Office $office
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeRequest $request, Office $office)
    {
        $office->update($request->all());

        return redirect()->route('admin.offices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Office $office
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->back();
    }
}
