<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Catalog, Helpers, Node, NodeImage};

class SecuredProductsController extends Controller
{
    /**
     * @param $product_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($product_type)
    {
        $nodesModel = new Node;
        $catalogModel = new Catalog;
        $getAllChildsCategories = $catalogModel->getAllChildsCategories($product_type);
        $getNodes = $nodesModel->getNodesForProductType($getAllChildsCategories);

        $data['products'] = $nodesModel->getNodesByType($getNodes, $product_type);
        $data['product_type'] = $product_type;

        return view('secured.nodes.index', $data);
    }

    /**
     * @param $product_type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($product_type)
    {
        return view($this->generateRouteView($product_type, 'create'), [
            'catalogRender' => (new Helpers())->buildCatalogOptionsWithLevels(Catalog::all()->toArray(), 0, '---', NULL, $product_type)
        ]);
    }

    /**
     * @param $product_type
     * @param Node $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($product_type, $id)
    {
        $relation = $product_type ? 'part' : 'machinery';

        $node = Node::with($relation)->find($id);

        $catalogRender = (new Helpers())->buildCatalogOptionsWithLevels(
            Catalog::all()->toArray(), 0, '---', $node->catalogs->map->cat_number->toArray(), $product_type
        );

        return view($this->generateRouteView($product_type, 'edit'), compact('node', 'catalogRender'));
    }

    /**
     * Generate path to view layout for product type
     *
     * @param $productType
     * @param $pageType
     * @return string
     */
    public function generateRouteView($productType, $pageType)
    {
        $nodeType = $productType ? 'parts' : 'equipment';

        return 'secured.nodes.' . $nodeType . '.' . $pageType;
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

        return redirect()->route('admin.products.index', 0);
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

        return redirect()->route('admin.products.index', 1);
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
