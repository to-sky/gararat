<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CatalogRequest;
use App\Http\Controllers\Controller;
use App\Models\Catalog;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.catalogs.index', [
            'catalogs' => Catalog::sortByParentChilds()->paginate()
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

        return view('admin.catalogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CatalogRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogRequest $request)
    {
        Catalog::create($request->all());

        return redirect()->route('admin.catalogs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        $this->generateParams();

        return view('admin.catalogs.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CatalogRequest $request
     * @param  \App\Models\Catalog $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogRequest $request, Catalog $catalog)
    {
        $catalog->update($request->all());

        return redirect()->route('admin.catalogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog $catalog
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();

        return redirect()->route('admin.catalogs.index');
    }

    /**
     * Share the same variables for different views
     */
    public function generateParams()
    {
        $catalogs = Catalog::parentCatalogs()->get();

        view()->share('catalogs', $catalogs);
    }
}