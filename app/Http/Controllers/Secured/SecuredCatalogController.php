<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;

class SecuredCatalogController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedCatalogListPage()
    {
        $data['pageTitle'] = 'Catalog';

        return view('secured.catalog.list', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedAddCatalogItemPage()
    {
        $data['pageTitle'] = 'New Catalog Item';

        return view('secured.catalog.add', $data);
    }
    //======================================================================
    // API
    //======================================================================
    public function saveNewCatalogItemAPI(Request $request)
    {
        $catalogModel = new Catalog;
        $data = $request->all();
        dd($data);
        return redirect()->route('securedCatalogListPage');
    }
}
