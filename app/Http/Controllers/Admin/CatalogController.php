<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CatalogRequest;
use App\Http\Controllers\Controller;
use App\Models\Catalog;
use Exception;
use Illuminate\Http\Response;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @return Response
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
     * @return Response
     */
    public function store(CatalogRequest $request)
    {
        Catalog::create($request->all());

        return redirect()->route('admin.catalogs.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Catalog $catalog
     * @return Response
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
     * @param Catalog $catalog
     * @return Response
     */
    public function update(CatalogRequest $request, Catalog $catalog)
    {
        $catalog->update($request->all());

        return redirect()->to($request->previous_page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Catalog $catalog
     * @return Response
     * @throws Exception
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();

        return back();
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
