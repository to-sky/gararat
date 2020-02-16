<?php

namespace App\Http\Controllers\Website;

use App\Models\FigureNode;
use App\Models\Machinery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use \App\Models\Catalog;
use \App\Models\Helpers;
use \App\Models\Node;
use \App\Models\Figure;
use \App\Models\Pages;

class CatalogController extends Controller
{
    /**
     * @param Request $request
     * @param $cid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function catalogPage(Request $request, $cid)
    {
        $catalog = Catalog::find($cid);

        $helpers = new Helpers;
        $nodesModel = new Node;
        $pagesModel = new Pages;
        $locale = App::getLocale();

        // Params
        $target = $request->target ?? 'price';
        $destination = $request->dest ?? 'ASC';
        $perPage = $request->per_page ?? 20;

        $data['pageTitle'] = $catalog->{'cat_title_'.$locale} ?? $catalog->{'cat_name_'.$locale};

        $getAllChildsCategories = $catalog->getAllChildsCategoriesFrontEnd($catalog->cat_number);
        $data['catalogChilds'] = $catalog->getCatalogChilds($catalog->cat_number);
        if($catalog->cat_type === 1) {
            $alias = 'parts';
            $stepsToRoot = $catalog->countParentsToRoot($catalog->parent_cat);

            if($stepsToRoot >= 2) {
                $getCatalogs = $catalog->getAllCatalogItemsByTypeWithoutRoot(1)->toArray();

                if(count($data['catalogChilds']) > 0) {
                    $data['preRenderedCatalog'] = $helpers->buildFrontendPartsCatalogMenu($cid, $getCatalogs, $catalog->cat_number);
                } else {
                    $data['preRenderedCatalog'] = $helpers->buildFrontendPartsCatalogMenu($cid, $getCatalogs, $catalog->parent_cat);
                }
            }
        } else {
            $alias = 'equipment';
        }
        $data['cid'] = $cid;
        $data['currentCatalog'] = $catalog;
        $data['catalogName'] = $catalog->{'cat_name_'.$locale};
        $data['pageDescription'] = $catalog->{'cat_description_'.$locale};
        $data['catalogType'] = $catalog->cat_type;
        $data['catalogView'] = $catalog->cat_view;
        $data['parentCatalog'] = $catalog->getCatalogByCatNumber($catalog->parent_cat);
        $data['breadcrumbs'] = $helpers->buildCatalogBreadcrumbs($catalog, false);

        $machineryIds = Machinery::all()->map->node;
        $getNodes = $catalog->cat_type ? Node::whereNotIn('id', $machineryIds)->get()->map->id : $machineryIds;

        // Get products
//        $getNodes = $nodesModel->getNodesForProductType($getAllChildsCategories);
        $data['products'] = $nodesModel->getNodesByType($getNodes->toArray(), $catalog->cat_type, $perPage, $target, $destination);
        $data['target'] = $target;
        $data['neededTarget'] = $destination == 'ASC' ? 'DESC' : 'ASC';
        $data['destination'] = $destination;
        $data['perPage'] = $perPage;
        $data['page'] = $pagesModel->getPageByAlias($alias);

        if($catalog->is_drawing === 1) {
            return redirect()->route('figuresCatalogPage', $cid);
        } else {
            return view('website.catalog.catalog', $data);
        }
    }

    public function figuresCatalogPage($cid)
    {
        $catalogModel = new Catalog;
        $helpers = new Helpers;
        $nodesModel = new Node;

        $locale = App::getLocale();
        $getCatalogByCid = Catalog::find($cid);

        if($locale === 'en') {
            if($getCatalogByCid->cat_title_en === NULL) {
                $data['pageTitle'] = $getCatalogByCid->cat_name_en;
            } else {
                $data['pageTitle'] = $getCatalogByCid->cat_title_en;
            }
        } else {
            if($getCatalogByCid->cat_title_en === NULL) {
                $data['pageTitle'] = $getCatalogByCid->cat_name_ar;
            } else {
                $data['pageTitle'] = $getCatalogByCid->cat_title_ar;
            }
        }
        $data['cid'] = $cid;
        $data['currentCatalog'] = $getCatalogByCid;
        $data['catalogName'] = $getCatalogByCid->cat_name_en;
        $data['catalogType'] = $getCatalogByCid->cat_type;
        $data['pageDescription'] = $getCatalogByCid->cat_description_en;
        $data['catalogChilds'] = $catalogModel->getCatalogChilds($getCatalogByCid->cat_number);
        if(count($data['catalogChilds']) === 0) {
            $data['parentCatalog'] = $catalogModel->getCatalogByCatNumber($getCatalogByCid->parent_cat);
        }
        $data['breadcrumbs'] = $helpers->buildCatalogBreadcrumbs($getCatalogByCid, false);
        // Figure
        $getFigure = Figure::find($getCatalogByCid->figure);
        $data['figure'] = $getFigure;
        if(isset($getFigure) && $getFigure !== null) {
            $getNodes = $nodesModel->getNodesForFigure($getFigure->fig_id);
            $data['nodes'] = $getNodes;
        } else {
            $data['nodes'] = null;
        }
        return view('website.catalog.figure', $data);
    }
}
