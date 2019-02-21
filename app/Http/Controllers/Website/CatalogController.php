<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Helpers;

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
        $getCatalogByCid = $catalogModel->getCatalogByCid($cid);
        if($getCatalogByCid->cat_title_en === NULL) {
            $data['pageTitle'] = $getCatalogByCid->cat_name_en;
        } else {
            $data['pageTitle'] = $getCatalogByCid->cat_title_en;
        }
        $data['catalogName'] = $getCatalogByCid->cat_name_en;
        $data['pageDescription'] = $getCatalogByCid->cat_description_en;
        $data['catalogChilds'] = $catalogModel->getCatalogChilds($getCatalogByCid->cat_number);
        $data['breadcrumbs'] = $helpers->buildCatalogBreadcrumbs($getCatalogByCid);

        return view('website.catalog.catalog', $data);
    }
}
