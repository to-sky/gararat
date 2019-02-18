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
    public function catalogPage($cat_number)
    {
        $catalogModel = new Catalog;
        $helpers = new Helpers;
        $getCatalogByCatNumber = $catalogModel->getCatalogByCatNumber($cat_number);

        if($getCatalogByCatNumber->cat_title_en === NULL) {
            $data['pageTitle'] = $getCatalogByCatNumber->cat_name_en;
        } else {
            $data['pageTitle'] = $getCatalogByCatNumber->cat_title_en;
        }
        $data['catalogName'] = $getCatalogByCatNumber->cat_name_en;
        $data['pageDescription'] = $getCatalogByCatNumber->cat_description_en;
        $data['catalogChilds'] = $catalogModel->getCatalogChilds($cat_number);
        $data['breadcrumbs'] = $helpers->buildCatalogBreadcrumbs($getCatalogByCatNumber);

        return view('website.catalog.catalog', $data);
    }
}
