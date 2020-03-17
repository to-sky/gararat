<?php

namespace App\Http\Controllers\Secured;

use App\Models\Equipment;
use App\Models\Machinery;
use App\Models\Order;
use App\Models\Pages;
use App\Models\Part;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Csv\Reader;
use \Carbon\Carbon;

use \App\Models\Node;

class PagesController extends Controller
{
    /**
     * Show list of all pages
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    /**
     * Edit homepage
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $pagesModel = new Pages;
        $getPage = $pagesModel->getHomePage();

        if($getPage === null) {
            $pagesModel->createDefaultHomePage();
        }

        $data['pageData'] = $pagesModel->getHomePage();
        return view('admin.pages.home', $data);
    }

    /**
     * Edit services page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function services()
    {
        $pagesModel = new Pages;
        $getPage = $pagesModel->getPageByAlias('services');

        if($getPage === null) {
            $pagesModel->createDefaultPage('services', 'Services', 'Services');
        }

        $data['pageData'] = $pagesModel->getPageByAlias('services');
        $data['title'] = 'Services';

        return view('admin.pages.contacts', $data);
    }

    /**
     * Edit contacts page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts()
    {
        $pagesModel = new Pages;
        $getPage = $pagesModel->getPageByAlias('contacts');

        if($getPage === null) {
            $pagesModel->createDefaultPage('contacts', 'Contacts', 'Contacts');
        }

        $data['pageData'] = $pagesModel->getPageByAlias('contacts');
        $data['title'] = 'Contacts';

        return view('admin.pages.contacts', $data);
    }

    /**
     * Edit parts or equipment page
     *
     * @param $catalog
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function catalog($catalog)
    {
        $pagesModel = new Pages;
        $getPage = $pagesModel->getPageByAlias($catalog);

        if($getPage === null) {
            $pagesModel->createDefaultPage('services', 'Services', 'Services');
        }

        $data['pageData'] = $pagesModel->getPageByAlias($catalog);
        $data['title'] = ucfirst($catalog);

        return view('admin.pages.catalog', $data);
    }

    /**
     * Admin dashboard main page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.dashboard.index', [
            'parts' => Part::all(),
            'equipment' => Equipment::all(),
            'orders' => Order::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Admin search page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminSearch(Request $request)
    {
        return view('admin.dashboard.search', [
            'products' => (new Node)->getNodesBySearchRequestSecured($request->q)
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadCSVPage()
    {
        return view('admin.dashboard.upload');
    }

    //======================================================================
    // API
    //======================================================================
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadEquipmentsCsvApi(Request $request)
    {
        // Settings
        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }
        // Save file
        $file = $request->file('uploadEQFile');
        $name = md5_file($file->getRealPath());
        $store = $file->storeAs('/public', Carbon::now()->format('d-m-Y') . '-' . uniqid() . '-' . $name.'.csv');
        $filePath = explode('/', $store);
        $filePath = $filePath[1];
        // CSV Reader
        $reader = Reader::createFromPath(public_path() . '/storage/' . $filePath, 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        // Loop each part and check if exist and create/update it
        $nodesModel = new Node;
        foreach ($records as $offset => $record) {
            // dd($record);
            $nodesModel->getEQCsvRecordToAnalyze($record);
        }
        return redirect()->route('admin.products.index', 0);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadPartsCsvApi(Request $request)
    {
        // Settings
        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }
        // Save file
        $file = $request->file('uploadPFile');
        $name = md5_file($file->getRealPath());
        $store = $file->storeAs('/public', Carbon::now()->format('d-m-Y') . '-' . uniqid() . '-' . $name.'.csv');
        $filePath = explode('/', $store);
        $filePath = $filePath[1];
        // CSV Reader
        $reader = Reader::createFromPath(public_path() . '/storage/' . $filePath, 'r');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        // Loop each part and check if exist and create/update it
        $nodesModel = new Node;
        foreach ($records as $offset => $record) {
            // dd($record);
            $nodesModel->getPartsCsvRecordToAnalyze($record);
        }
        return redirect()->route('admin.products.index', 1);
    }
}
