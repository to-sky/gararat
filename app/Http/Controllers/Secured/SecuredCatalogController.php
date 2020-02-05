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
        $getCatalogArray = $helper->convertQueryBuilderToArray($catalogModel->get());
        $data['catalog'] = $helper->buildCatalogMenuWithLevels($getCatalogArray, 0);

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
        $getCatalogArray = $helper->convertQueryBuilderToArray($catalogModel->get());
        $data['catalogs'] = $helper->buildCatalogOptionsWithLevels($getCatalogArray, 0, '', NULL, NULL);

        return view('secured.catalog.add', $data);
    }

    /**
     * @param $cid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedEditCatalogItemPage($cid)
    {
        $catalogModel = new Catalog;
        $helper = new Helpers;
        $getCatalogItem = $catalogModel->find($cid);

        $data['pageTitle'] = 'Edit Catalog: ' . $getCatalogItem->cat_name_en;
        $getCatalogArray = $helper->convertQueryBuilderToArray($catalogModel->get());
        $data['catalogs'] = $helper->buildCatalogOptionsWithLevels($getCatalogArray, 0, '---', $getCatalogItem->parent_cat, NULL);
        $data['catalogItem'] = $getCatalogItem;

        return view('secured.catalog.edit', $data);
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
            return redirect()->route('securedCatalogListPage');
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
            return redirect()->route('securedCatalogListPage');
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
