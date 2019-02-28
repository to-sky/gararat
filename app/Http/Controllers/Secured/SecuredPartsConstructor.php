<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Figures;
use \App\Models\Helpers;
use \App\Models\Nodes;

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

    /**
     * @param $fig_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createNewConstructorDrawingPage($fig_id)
    {
        $catalogModel = new Catalog;
        $figuresModel = new Figures;
        $nodesModel = new Nodes;

        $getFigure = $figuresModel->getFigureById($fig_id);
        $getCatalgoByCatNumber = $catalogModel->getCatalogByCatNumber($getFigure->catalog);
        $getNodes = $nodesModel->getNodesForFigure($getFigure->fig_no);
        foreach ($getNodes as $node) {
            $figuresModel->createOrUpdateNodeForFigure($node->nid, $fig_id);
        }

        $data['pageTitle'] = $getCatalgoByCatNumber->cat_name_en . ' Figure';
        $data['figure'] = $getFigure;
        $data['nodes'] = $getNodes;
        $data['fig_id'] = $fig_id;

        return view('secured.figures.construct', $data);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveConstructorBuilderAPI(Request $request)
    {
        $figuresModel = new Figures;
        $data = $request->all();
        $figuresModel->saveParamsForFigureNode($data);
        return response()->json(['response' => 200]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearConstructorBuilderAPI(Request $request)
    {
        $figuresModel = new Figures;
        $data = $request->all();
        $figuresModel->clearFigureNode($data);
        return response()->json(['response' => 200]);
    }
}
