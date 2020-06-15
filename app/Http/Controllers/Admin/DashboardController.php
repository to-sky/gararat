<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\{Equipment, Order, Part, Subscriber};
use App\Services\BackupService;
use App\Services\ProductService;

class DashboardController extends Controller
{
    /**
     * Dashboard main page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard.index', [
            'parts' => Part::all(),
            'equipment' => Equipment::all(),
            'orders' => Order::all(),
            'subscribers' => Subscriber::active()->get(),
            'backupFiles' => BackupService::getFiles()
        ]);
    }

    /**
     * Download backup file
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadBackup()
    {
        return response()->download(request('pathToFile'));
    }

    /**
     * Search page
     *
     * @param SearchRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        return view('admin.dashboard.search', [
            'products' => ProductService::searchProduct($request->q)->paginate()
        ]);
    }
}
