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
    public function catalogPage(Request $request, $cid)
    {
        $catalogModel = new Catalog;
        $helpers = new Helpers;
        $nodesModel = new Nodes;

        // Params
        $target = $request->query('target');
        $destination = $request->query('dest');
        $perPage = $request->query('per_page');
        if($target === NULL) { $target = 'price'; }
        if($destination === NULL) { $destination = 'ASC'; }
        if($perPage === NULL) { $perPage = 20; }
        $neededDest = $destination;
        switch($destination) {
            case 'ASC':
                $neededTarget = 'DESC';
                break;
            case 'DESC':
                $neededTarget = 'ASC';
                break;
            default:
                $neededTarget = 'ASC';
                break;
        }

        $getCatalogByCid = $catalogModel->getCatalogByCid($cid);
        if($getCatalogByCid->cat_title_en === NULL) {
            $data['pageTitle'] = $getCatalogByCid->cat_name_en;
        } else {
            $data['pageTitle'] = $getCatalogByCid->cat_title_en;
        }
        $data['cid'] = $cid;
        $data['catalogName'] = $getCatalogByCid->cat_name_en;
        $data['catalogType'] = $getCatalogByCid->cat_type;
        $data['pageDescription'] = $getCatalogByCid->cat_description_en;
        $data['catalogChilds'] = $catalogModel->getCatalogChilds($getCatalogByCid->cat_number);
        if(count($data['catalogChilds']) === 0) {
            $data['parentCatalog'] = $catalogModel->getCatalogByCatNumber($getCatalogByCid->parent_cat);
        }
        $data['breadcrumbs'] = $helpers->buildCatalogBreadcrumbs($getCatalogByCid, false);
        // Get products
        $getAllChildsCategories = $catalogModel->getAllChildsCategories($getCatalogByCid->cat_number);
        $getNodes = $nodesModel->getNodesForProductType($getAllChildsCategories);
        $data['products'] = $nodesModel->getNodesByType($getNodes, $getCatalogByCid->cat_type, $perPage, $target, $destination);
        $data['target'] = $target;
        $data['neededTarget'] = $neededTarget;
        $data['destination'] = $destination;
        $data['perPage'] = $perPage;

        return view('website.catalog.catalog', $data);
    }
}
