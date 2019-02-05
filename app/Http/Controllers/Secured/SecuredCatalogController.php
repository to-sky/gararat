<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $data['pageTitle'] = 'Catalog';

        return view('secured.catalog.list', $data);
    }
    //======================================================================
    // API
    //======================================================================

}
