<?php

namespace App\Http\Controllers\Secured;

use App\Models\FigureNode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Figure;
use \App\Models\Helpers;
use \App\Models\Node;

class PartsConstructor extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.figures.index', [
            'figures' => Figure::paginate(20)
        ]);
    }

    /**
     * Create new figure
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.figures.create', [
            'catalogRender' => (new Helpers)->buildCatalogOptionsWithLevels(
                Catalog::getAllCatalogItemsByType(1)->toArray(), 0, '', NULL, NULL)
        ]);
    }

    /**
     * Show constructor page and update node for figure
     *
     * @param Figure $figure
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createConstructor(Figure $figure)
    {
        Figure::createOrUpdateNodeForFigure($figure->fig_id, $figure->fig_no);

        $separatedNodesParts = $figure->getSeparatedNodesWithParts();

        return view('admin.figures.construct', compact('figure', 'separatedNodesParts'));
    }

    /**
     * Delete figure
     *
     * @param Request $request
     * @param $fig_no
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $fig_no)
    {
        $figuresModel = new Figure;
        $catalog = $request->query('catalog');
        $figuresModel->removeFigure($fig_no, $catalog);

        return redirect()->back();
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
        $figuresModel = new Figure;
        $data = $request->all();
        $file = $request->file('figureImage');
        $createFigure = $figuresModel->initFigure($data, $file);

        return redirect()->route('admin.figures.constructor.create', $createFigure);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveConstructorBuilderAPI(Request $request)
    {
        $figuresModel = new Figure;
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
        $figuresModel = new Figure;
        $data = $request->all();
        $figuresModel->clearFigureNode($data);
        return response()->json(['response' => 200]);
    }
}
