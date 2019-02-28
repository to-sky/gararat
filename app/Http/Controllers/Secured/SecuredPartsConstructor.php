<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Figures;
use \App\Models\Helpers;

class SecuredPartsConstructor extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    public function listConstructorPage()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initNewConstructorDrawingPage()
    {
        $catalogModel = new Catalog;
        $helper = new Helpers;

        $data['pageTitle'] = 'Init New Constructor Item';
        $getCatalogArray = $helper->convertQueryBuilderToArray($catalogModel->getAllCatalogItemsByType(1));
        $data['catalogs'] = $helper->buildCatalogOptionsWithLevels($getCatalogArray, 0, '', NULL, NULL);

        return view('secured.figures.init', $data);
    }

    public function createNewConstructorDrawingPage($fig_id)
    {

    }
    //======================================================================
    // API
    //======================================================================
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveConstructorInitAPI(Request $request)
    {
        $figuresModel = new Figures;
        $data = $request->all();
        $file = $request->file('figureImage');
        $createFigure = $figuresModel->initFigure($data, $file);
        return redirect()->route('createNewConstructorDrawingPage', $createFigure);
    }
}
