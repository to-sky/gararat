<?php

namespace App\Http\Controllers\Secured;

use App\Http\Controllers\Controller;
use App\Exports\{EquipmentExport, PartExport};
use App\Imports\{EquipmentImport, PartImport};
use App\Http\Requests\{ExportRequest, ImportRequest};
use Maatwebsite\Excel\Facades\Excel;

class ImporterController extends Controller
{
    /**
     * Display index page for importer
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard.importer');
    }

    /**
     * Export equipment or parts
     *
     * @param ExportRequest $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(ExportRequest $request)
    {
        return $request->export_type == 'equipment'
            ? Excel::download(new EquipmentExport(), 'equipment.xlsx')
            : Excel::download(new PartExport(), 'parts.xlsx');

    }

    /**
     * Import equipment or parts
     *
     * @param ImportRequest $request
     * @return \Maatwebsite\Excel\Excel
     */
    public function import(ImportRequest $request)
    {
        $request->import_type == 'equipment'
            ? Excel::import(new EquipmentImport, $request->file('import_file'))
            : Excel::import(new PartImport, $request->file('import_file'));

        return redirect()->route('admin.importer.index');
    }
}
