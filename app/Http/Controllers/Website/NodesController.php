<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Helpers;
use \App\Models\Nodes;

class NodesController extends Controller
{
    /**
     * @param $nid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function singleNodePage($nid)
    {
        $catalogModel = new Catalog;
        $helpers = new Helpers;
        $nodesModel = new Nodes;

        $getNodeCatalog = $catalogModel->getCatalogByNodeId($nid);
        $getNode = $nodesModel->getNodeByCatalogType($nid, $getNodeCatalog->cat_type);

        if($getNode->n_title_en === NULL) {
            $data['pageTitle'] = $getNode->n_name_en;
        } else {
            $data['pageTitle'] = $getNode->n_title_en;
        }
        $breadcrumbs = $helpers->buildCatalogBreadcrumbs($getNodeCatalog, true);
        $breadcrumbs[] = array('name' => $getNode->n_name_en, 'route' => NULL, 'param' => NULL);
        $data['breadcrumbs'] = $breadcrumbs;
        $data['product'] = $getNode;
        $data['images'] = $nodesModel->getNodeImagesWithParams($nid, 0);
        $data['featuredImage'] = $nodesModel->getNodeImagesWithParams($nid, 1);

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
