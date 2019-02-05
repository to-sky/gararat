<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Helpers;

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
        $catalogModel = new Catalog;
        $helper = new Helpers;

        $data['pageTitle'] = 'Catalog';
        $data['catalogs'] = $helper->buildCatalogWithLevels($catalogModel->getAllCatalogItems());

        return view('secured.catalog.list', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedAddCatalogItemPage()
    {
        $catalogModel = new Catalog;
        $helper = new Helpers;

        $data['pageTitle'] = 'New Catalog Item';
        $data['catalogs'] = $helper->buildCatalogWithLevels($catalogModel->getAllCatalogItems());

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
