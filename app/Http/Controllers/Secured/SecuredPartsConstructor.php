<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Figures;

class SecuredPartsConstructor extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    public function listConstructorPage()
    {

    }

    public function initNewConstructorDrawingPage()
    {
        $figureModel = new Figures;
    }

    public function createNewConstructorDrawingPage($fig_id)
    {

    }
    //======================================================================
    // API
    //======================================================================
}
