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
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNewCatalogItemAPI(Request $request)
    {
        $catalogModel = new Catalog;
        $data = $request->all();
        $findDublicatesCatId = $catalogModel->findCatalogItemByCatId($data['catalogNumber']);
        if($findDublicatesCatId == 0) {
            $catalogModel->saveNewCatalogItem($data);
            return redirect()->route('securedCatalogListPage');
        } else {
            return redirect()->back()->withErrors('Catalog number must be unique');
        }
    }
}
