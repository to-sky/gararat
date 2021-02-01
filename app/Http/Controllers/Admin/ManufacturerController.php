<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManufacturerRequest;
use App\Models\Manufacturer;
use Exception;
use Illuminate\Http\Response;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.manufacturers.index', [
            'manufacturers' => Manufacturer::latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.manufacturers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ManufacturerRequest $request
     * @return Response
     */
    public function store(ManufacturerRequest $request)
    {
        Manufacturer::create($request->all());

        return redirect()->route('admin.manufacturers.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Manufacturer $manufacturer
     * @return Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ManufacturerRequest $request
     * @param Manufacturer $manufacturer
     * @return Response
     */
    public function update(ManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $manufacturer->update($request->all());

        return redirect()->to($request->previous_page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Manufacturer $manufacturer
     * @return Response
     * @throws Exception
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return back();
    }
}
