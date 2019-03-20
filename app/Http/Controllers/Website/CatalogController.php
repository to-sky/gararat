<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Helpers;
use \App\Models\Nodes;
use \App\Models\Figures;

class CatalogController extends Controller
{
    /**
     * @param Request $request
     * @param $cid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
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
        $getAllChildsCategories = $catalogModel->getAllChildsCategoriesFrontEnd($getCatalogByCid->cat_number);
        $data['catalogChilds'] = $catalogModel->getCatalogChilds($getCatalogByCid->cat_number);
        if($getCatalogByCid->cat_type === 1) {
            $stepsToRoot = $catalogModel->countParentsToRoot($getCatalogByCid->parent_cat);
            if($stepsToRoot >= 2) {
                $getCatalogs = $catalogModel->getAllCatalogItemsByTypeWithoutRoot(1);
                if(count($data['catalogChilds']) > 0) {
                    $data['preRenderedCatalog'] = $helpers->buildFrontendPartsCatalogMenu($cid, $helpers->convertQueryBuilderToArray($getCatalogs), $getCatalogByCid->cat_number);
                } else {
                    $data['preRenderedCatalog'] = $helpers->buildFrontendPartsCatalogMenu($cid, $helpers->convertQueryBuilderToArray($getCatalogs), $getCatalogByCid->parent_cat);
                }
            }
        }
        $data['cid'] = $cid;
        $data['currentCatalog'] = $getCatalogByCid;
        $data['catalogName'] = $getCatalogByCid->cat_name_en;
        $data['catalogType'] = $getCatalogByCid->cat_type;
        $data['catalogView'] = $getCatalogByCid->cat_view;
        $data['pageDescription'] = $getCatalogByCid->cat_description_en;
        $data['parentCatalog'] = $catalogModel->getCatalogByCatNumber($getCatalogByCid->parent_cat);
        $data['breadcrumbs'] = $helpers->buildCatalogBreadcrumbs($getCatalogByCid, false);
        // Get products
        $getNodes = $nodesModel->getNodesForProductType($getAllChildsCategories);
        $data['products'] = $nodesModel->getNodesByType($getNodes, $getCatalogByCid->cat_type, $perPage, $target, $destination);
        $data['target'] = $target;
        $data['neededTarget'] = $neededTarget;
        $data['destination'] = $destination;
        $data['perPage'] = $perPage;
        if($getCatalogByCid->is_drawing === 1) {
            return redirect()->route('figuresCatalogPage', $cid);
        } else {
            return view('website.catalog.catalog', $data);
        }
    }

    public function figuresCatalogPage($cid)
    {
        $catalogModel = new Catalog;
        $helpers = new Helpers;
        $nodesModel = new Nodes;
        $figuresModel = new Figures;

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
        // Figure
        $getFigure = $figuresModel->getFigureById($getCatalogByCid->figure);
        $getNodes = $nodesModel->getNodesForFigure($getFigure->fig_id);
        $data['figure'] = $getFigure;
        $data['nodes'] = $getNodes;

        return view('website.catalog.figure', $data);
    }
}
