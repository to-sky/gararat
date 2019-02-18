<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Catalog;
use \App\Models\Helpers;
use \App\Models\Nodes;

class SecuredProductsController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    public function productsListSecuredPage($product_type)
    {
        $nodesModel = new Nodes;
        $catalogModel = new Catalog;
        $getAllChildsCategories = $catalogModel->getAllChildsCategories($product_type);
        $getNodes = $nodesModel->getNodesForProductType($getAllChildsCategories);

        switch($product_type) {
            case 1:
                $data['pageTitle'] = 'Equipment nodes';
                break;
            case 2:
                $data['pageTitle'] = 'Equipment nodes';
                break;
            default:
                $data['pageTitle'] = 'Nodes';
                break;
        }

        $data['products'] = $nodesModel->getNodesByType($getNodes, $product_type);
        dd($data['products']);

        return view('secured.nodes.list', $data);
    }
    /**
     * @param $product_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function addNewProduct($product_type)
    {
        $helpersModel = new Helpers;
        $catalogModel = new Catalog;
        // Catalog operations
        $getCatalog = $catalogModel->getAllCatalogItems();
        $getCatalogArray = $helpersModel->convertQueryBuilderToArray($getCatalog);
        $buildCatalogOptions = $helpersModel->buildCatalogOptionsWithLevels($getCatalogArray, 0, '---', NULL, $product_type);

        $data['catalog'] = $buildCatalogOptions;

        switch($product_type) {
            case 1:
                $data['pageTitle'] = 'Add new equipment node';
                return view('secured.nodes.equipment.add', $data);
                break;
            case 2:
                $data['pageTitle'] = 'Add new parts node';
                return view('secured.nodes.parts.add', $data);
                break;
            default:
                return redirect()->route('productsListSecuredPage', 1);
                break;
        }
    }
    //======================================================================
    // API
    //======================================================================
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNewEquipmentAPI(Request $request)
    {
        $nodesModel = new Nodes;
        $data = $request->all();
        $mainImage = $request->file('mainImage');
        $additionalImages = $request->file('additionalImages');
        // Save node
        $saveNode = $nodesModel->createBasicNode($data);
        // Save equipment data
        $nodesModel->saveEquipmentNode($saveNode, $data);
        // Set node to catalog
        $nodesModel->setNodeToCatalog($saveNode, $data['catalog']);
        // Proceed images
        if($mainImage !== NULL) {
            $nodesModel->saveNewNodeImage($saveNode, $mainImage, 1);
        }
        if($additionalImages !== NULL) {
            foreach ($additionalImages as $image) {
                $nodesModel->saveNewNodeImage($saveNode, $image, 0);
            }
        }
        return redirect()->route('productsListSecuredPage', 1);
    }
}
