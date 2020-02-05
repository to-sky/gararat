<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

use \App\Models\Catalog;
use \App\Models\Helpers;
use \App\Models\Node;

class NodesController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function singleNodePage($id)
    {
        $catalogModel = new Catalog;
        $helpers = new Helpers;
        $nodesModel = new Node;
        $locale = App::getLocale();

        $getNodeCatalog = $catalogModel->getCatalogByNodeId($id);
        $getNode = $nodesModel->getNodeByCatalogType($id, $getNodeCatalog->cat_type);

        if($locale == 'ar') {
            if($getNode->n_title_ar === NULL) {
                $data['pageTitle'] = $getNode->n_name_ar;
            } else {
                $data['pageTitle'] = $getNode->n_title_ar;
            }
        } else {
            if($getNode->n_title_en === NULL) {
                $data['pageTitle'] = $getNode->n_name_en;
            } else {
                $data['pageTitle'] = $getNode->n_title_en;
            }
        }

        $breadcrumbs = $helpers->buildCatalogBreadcrumbs($getNodeCatalog, true);
        $breadcrumbs[] = array('name' => $getNode->n_name_en, 'route' => NULL, 'param' => NULL);
        $data['breadcrumbs'] = $breadcrumbs;
        $data['product'] = $getNode;
        $data['images'] = $nodesModel->getNodeImagesWithParams($id, 0);
        $data['featuredImage'] = $nodesModel->getNodeImagesWithParams($id, 1);

        switch($getNodeCatalog->cat_type) {
            case 0:
                return view('website.nodes.equipment', $data);
                break;
            default:
                return view('website.nodes.parts', $data);
                break;
        }
    }
}
