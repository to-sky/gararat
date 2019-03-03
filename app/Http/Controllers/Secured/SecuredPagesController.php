<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use \App\Models\Nodes;

class SecuredPagesController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedDashboardPage()
    {
        $data['pageTitle'] = 'Dashboard';

        return view('secured.dashboard', $data);
    }

    public function securedSearchPage(Request $request)
    {
        $nodesModel = new Nodes;
        $query = $request->query('q');

        $data['pageTitle'] = 'Search results for: ' . $query;
        $data['searchRequest'] = $query;
        $data['products'] = $nodesModel->getNodesBySearchRequestSecured($query);

        return view('secured.search', $data);
    }
    //======================================================================
    // API
    //======================================================================

}
