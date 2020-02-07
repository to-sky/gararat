<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Catalog, Helpers, Node, NodeImage};

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
        $nodesModel = new Node;
        $catalogModel = new Catalog;
        $getAllChildsCategories = $catalogModel->getAllChildsCategories($product_type);
        $getNodes = $nodesModel->getNodesForProductType($getAllChildsCategories);

        switch($product_type) {
            case 0:
                $data['pageTitle'] = 'Equipment nodes';
                break;
            case 1:
                $data['pageTitle'] = 'Parts nodes';
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
        $getCatalogArray = $helpersModel->convertQueryBuilderToArray($catalogModel->get());
        $buildCatalogOptions = $helpersModel->buildCatalogOptionsWithLevels($getCatalogArray, 0, '---', NULL, $product_type);

        $data['catalog'] = $buildCatalogOptions;

        switch($product_type) {
            case 0:
                $data['pageTitle'] = 'Add new equipment node';
                return view('secured.nodes.equipment.add', $data);
                break;
            case 1:
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
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editNode($product_type, $id)
    {
        $helpersModel = new Helpers;
        $catalogModel = new Catalog;
        $nodesModel = new Node;
        // Catalog operations
        $selectedCatalogs = $catalogModel->getSelectedCatalogItem($id);
        $getCatalogArray = $helpersModel->convertQueryBuilderToArray($catalogModel->get());
        $buildCatalogOptions = $helpersModel->buildCatalogOptionsWithLevels($getCatalogArray, 0, '---', $selectedCatalogs, $product_type);

        $data['catalog'] = $buildCatalogOptions;
        $data['node'] = $nodesModel->getNodeById($id, $product_type);
        $data['images'] = $nodesModel->getNodeImages($id);

        switch($product_type) {
            case 0:
                $data['pageTitle'] = 'Edit';
                return view('secured.nodes.equipment.edit', $data);
                break;
            case 1:
                $data['pageTitle'] = 'Edit';
                return view('secured.nodes.parts.edit', $data);
                break;
            default:
                return redirect()->route('productsListSecuredPage', $product_type);
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
        $nodesModel = new Node;
        $data = $request->all();

        // Save node
        $saveNode = $nodesModel->createBasicNode($data);

        // Save equipment data
        $nodesModel->saveEquipmentNode($saveNode->id, $data);

        // Set node to catalog
        $nodesModel->setNodeToCatalog($saveNode->id, $data['catalog']);

        // Proceed images
        $this->saveProductImage($saveNode->id);

        return redirect()->route('productsListSecuredPage', 0);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateEquipmentAPI(Request $request)
    {
        $nodesModel = new Node;
        $data = $request->all();

        $nodesModel->updateBasicNode($data);
        $nodesModel->updateEquipmentNode($data);
        $nodesModel->setNodeToCatalog($data['id'], $data['catalog']);

        // Proceed images
        $this->saveProductImage($data['id']);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNewPartsAPI(Request $request)
    {
        $nodesModel = new Node;
        $data = $request->all();

        // Save node
        $saveNode = $nodesModel->createBasicNode($data);

        // Save parts node
        $nodesModel->savePartsNode($saveNode->id, $data);

        // Set node to catalog
        $nodesModel->setNodeToCatalog($saveNode->id, $data['catalog']);

        // Proceed images
        $this->saveProductImage($saveNode->id);

        return redirect()->route('productsListSecuredPage', 1);
    }

    public function updatePartsAPI(Request $request)
    {
        $nodesModel = new Node;
        $data = $request->all();

        $nodesModel->updateBasicNode($data);
        $nodesModel->updatePartsNode($data);
        $nodesModel->setNodeToCatalog($data['id'], $data['catalog']);

        // Proceed images
        $this->saveProductImage($data['id']);

        return redirect()->back();
    }

    /**
     * Save product images (main and additional)
     *
     * @param $id | Node id
     * @return bool
     */
    public function saveProductImage($id)
    {
        if ($mainImage = request()->file('mainImage')) {
            (new Node())->saveNewNodeImage($id, $mainImage, 1);
        }

        if ($additionalImages = request()->file('additionalImages')) {
            foreach ($additionalImages as $image) {
                (new Node())->saveNewNodeImage($id, $image, 0);
            }
        }

        return null;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProductAPI($id)
    {
        $nodesModel = new Node;
        $nodesModel->removeNodeById($id);
        return redirect()->back();
    }

    /**
     * @param $id | Node Image
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeProductImage($id)
    {
        NodeImage::destroy($id);

        return redirect()->back();
    }
}
