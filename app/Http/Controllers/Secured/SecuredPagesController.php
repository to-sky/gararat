<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecuredPagesController extends Controller
{
    //======================================================================
    // PAGES
    //======================================================================
    public function securedDashboardPage()
    {
        dd('Dashboard');
    }
    //======================================================================
    // API
    //======================================================================

}
