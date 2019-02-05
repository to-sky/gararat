<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    //======================================================================
    // API
    //======================================================================

}
