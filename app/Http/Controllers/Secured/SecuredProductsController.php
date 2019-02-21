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
    /**
     * @param $product_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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
        $data['product_type'] = $product_type;

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
                return redirect()->route('productsListSecuredPage', $product_type);
                break;
        }
    }

    /**
     * @param $product_type
     * @param $nid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editNode($product_type, $nid)
    {
        $helpersModel = new Helpers;
        $catalogModel = new Catalog;
        $nodesModel = new Nodes;
        // Catalog operations
        $selectedCatalogs = $catalogModel->getSelectedCatalogItem($nid);
        $getCatalog = $catalogModel->getAllCatalogItems();
        $getCatalogArray = $helpersModel->convertQueryBuilderToArray($getCatalog);
        $buildCatalogOptions = $helpersModel->buildCatalogOptionsWithLevels($getCatalogArray, 0, '---', $selectedCatalogs, $product_type);

        $data['catalog'] = $buildCatalogOptions;
        $data['node'] = $nodesModel->getNodeById($nid, $product_type);
        $data['images'] = $nodesModel->getNodeImages($nid);

        switch($product_type) {
            case 1:
                $data['pageTitle'] = 'Edit';
                return view('secured.nodes.equipment.edit', $data);
                break;
            case 2:
                $data['pageTitle'] = 'Edit';
                return view('secured.nodes.parts.edit', $data);
                break;
            default:
                return redirect()->route('productsListSecuredPage', $product_type);
                break;
        }
    }

    public function deleteNode($nid)
    {

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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEquipmentAPI(Request $request)
    {
        $nodesModel = new Nodes;
        $data = $request->all();
        $mainImage = $request->file('mainImage');
        $additionalImages = $request->file('additionalImages');
        $nodesModel->updateBasicNode($data);
        $nodesModel->updateEquipmentNode($data);
        $nodesModel->setNodeToCatalog($data['nid'], $data['catalog']);
        if($mainImage !== NULL) {
            $nodesModel->saveNewNodeImage($data['nid'], $mainImage, 1);
        }
        if($additionalImages !== NULL) {
            foreach ($additionalImages as $image) {
                $nodesModel->saveNewNodeImage($data['nid'], $image, 0);
            }
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNewPartsAPI(Request $request)
    {
        $nodesModel = new Nodes;
        $data = $request->all();
        $mainImage = $request->file('mainImage');
        $additionalImages = $request->file('additionalImages');
        // Save node
        $saveNode = $nodesModel->createBasicNode($data);
        // Save parts node
        $nodesModel->savePartsNode($saveNode, $data);
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
        return redirect()->route('productsListSecuredPage', 2);
    }

    public function updatePartsAPI(Request $request)
    {
        $nodesModel = new Nodes;
        $data = $request->all();
        $mainImage = $request->file('mainImage');
        $additionalImages = $request->file('additionalImages');
        $nodesModel->updateBasicNode($data);
        $nodesModel->updatePartsNode($data);
        $nodesModel->setNodeToCatalog($data['nid'], $data['catalog']);
        if($mainImage !== NULL) {
            $nodesModel->saveNewNodeImage($data['nid'], $mainImage, 1);
        }
        if($additionalImages !== NULL) {
            foreach ($additionalImages as $image) {
                $nodesModel->saveNewNodeImage($data['nid'], $image, 0);
            }
        }
        return redirect()->back();
    }

    /**
     * @param $nid
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProductAPI($nid)
    {
        $nodesModel = new Nodes;
        $nodesModel->removeNodeById($nid);
        return redirect()->back();
    }

    /**
     * @param $ni_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProductImage($ni_id)
    {
        $nodesModel = new Nodes;
        $nodesModel->deleteImageById($ni_id);
        return redirect()->back();
    }
}
