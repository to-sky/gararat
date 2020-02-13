<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\{
    Catalog, Helpers
};

class SecuredCatalogController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('secured.catalog.index', [
            'catalogRender' => (new Helpers)->buildCatalogMenuWithLevels(Catalog::all()->toArray(), 0)
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('secured.catalog.create', [
            'catalogRender' => (new Helpers)->buildCatalogOptionsWithLevels(Catalog::all()->toArray(), 0, '', NULL, NULL)
        ]);
    }

    /**
     * @param Catalog $catalog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Catalog $catalog)
    {
        $catalogRender = (new Helpers())->buildCatalogOptionsWithLevels(
            Catalog::all()->toArray(), 0, '---', $catalog->parent_cat, NULL
        );

        return view('secured.catalog.edit', compact('catalog', 'catalogRender'));
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
            $catalogModel->saveNewCatalogItem($data, $request->file('catalogImage'));
            return redirect()->route('admin.catalog.index');
        } else {
            return redirect()->back()->withErrors('Catalog number must be unique');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCatalogItemAPI(Request $request)
    {
        $catalogModel = new Catalog;
        $data = $request->all();
        $findDublicatesCatId = $catalogModel->findCatalogItemByCatIdAndCid($data['catalogNumber'], $data['cid']);
        if($findDublicatesCatId == 0) {
            $catalogModel->updateCatalogItem($data, $request->file('catalogImage'));
            return redirect()->route('admin.catalog.index');
        } else {
            return redirect()->back()->withErrors('Catalog number must be unique');
        }
    }

    /**
     * @param $cid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function securedDeleteCatalogItemPage($cid)
    {
        $catalogModel = new Catalog;
        $getCurrentCatalogItemsParent = $catalogModel->getCatalogItemParentId($cid);
        $catalogModel->changeParentCategory($cid, $getCurrentCatalogItemsParent->parent_cat);
        $catalogModel->deleteCategoryItem($cid);
        return redirect()->back();
    }
}
