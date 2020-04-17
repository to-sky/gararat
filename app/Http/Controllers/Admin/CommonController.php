<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class CommonController extends Controller
{
    /**
     * Update page
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePageItemAPI(Request $request)
    {
        $pagesModel = new Page;
        $data = $request->all();
        $pagesModel->updateDefaultPage($data);

        return redirect()->route('admin.pages.index');
    }

    /**
     * Update Homepage
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateHomePageItemAPI(Request $request)
    {
        $pagesModel = new Page;
        $data = $request->all();
        $pagesModel->updateHomePage($data);

        return redirect()->route('admin.pages.index');
    }
}
