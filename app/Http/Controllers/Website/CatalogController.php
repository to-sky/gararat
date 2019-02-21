<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Helpers;
use \App\Models\Nodes;

class CatalogController extends Controller
{
    /**
     * @param $cat_number
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function catalogPage($cid)
    {
        $catalogModel = new Catalog;
        $helpers = new Helpers;
        $nodesModel = new Nodes;

        $getCatalogByCid = $catalogModel->getCatalogByCid($cid);
        if($getCatalogByCid->cat_title_en === NULL) {
            $data['pageTitle'] = $getCatalogByCid->cat_name_en;
        } else {
            $data['pageTitle'] = $getCatalogByCid->cat_title_en;
        }
        $data['catalogName'] = $getCatalogByCid->cat_name_en;
        $data['pageDescription'] = $getCatalogByCid->cat_description_en;
        $data['catalogChilds'] = $catalogModel->getCatalogChilds($getCatalogByCid->cat_number);
        if(count($data['catalogChilds']) === 0) {
            $data['parentCatalog'] = $catalogModel->getCatalogByCatNumber($getCatalogByCid->parent_cat);
        }
        $data['breadcrumbs'] = $helpers->buildCatalogBreadcrumbs($getCatalogByCid);
        // Get products
        $getAllChildsCategories = $catalogModel->getAllChildsCategories($getCatalogByCid->cat_number);
        $getNodes = $nodesModel->getNodesForProductType($getAllChildsCategories);
        $data['products'] = $nodesModel->getNodesByType($getNodes, $getCatalogByCid->cat_type);

        return view('website.catalog.catalog', $data);
    }
}
