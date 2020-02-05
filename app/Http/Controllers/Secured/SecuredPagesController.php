<?php

namespace App\Http\Controllers\Secured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Csv\Reader;
use \Carbon\Carbon;

use \App\Models\Node;

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
        $nodesModel = new Node;

        $data['pageTitle'] = 'Dashboard';
        $data['partsCount'] = $nodesModel->countPartsNodes();
        $data['eqCount'] = $nodesModel->countEquipmentsNodes();

        return view('secured.dashboard', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function securedSearchPage(Request $request)
    {
        $nodesModel = new Node;
        $query = $request->query('q');

        $data['pageTitle'] = 'Search results for: ' . $query;
        $data['searchRequest'] = $query;
        $data['products'] = $nodesModel->getNodesBySearchRequestSecured($query);

        return view('secured.search', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploadCSVPage()
    {
        $data['pageTitle'] = 'Upload CSV';

        return view('secured.upload', $data);
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
        return redirect()->route('productsListSecuredPage', 0);
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
        return redirect()->route('productsListSecuredPage', 1);
    }
}
