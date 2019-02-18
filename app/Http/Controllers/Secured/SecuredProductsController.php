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
    public function addNewProduct($product_type)
    {
        $helpersModel = new Helpers;
        $catalogModel = new Catalog;
        $nodesModel = new Nodes;
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
                return redirect()->route('securedDashboardPage');
                break;
        }
    }
    //======================================================================
    // API
    //======================================================================
    
}
