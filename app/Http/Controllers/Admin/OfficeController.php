<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeRequest;
use App\Models\Office;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view('admin.offices.index', [
            'offices' => Office::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $sitePosition = Office::getLastSitePosition() + 1;

        return view('admin.offices.create', compact('sitePosition'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OfficeRequest $request
     * @return RedirectResponse
     */
    public function store(OfficeRequest $request)
    {
        Office::create($request->all());

        return redirect()->route('admin.offices.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Office $office
     * @return Application|Factory|Response|View
     */
    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OfficeRequest $request
     * @param Office $office
     * @return RedirectResponse
     */
    public function update(OfficeRequest $request, Office $office)
    {
        $office->update($request->all());

        return redirect()->route('admin.offices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Office $office
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return back();
    }

    /**
     * Update site position after Drag'n'Drop on the table
     */
    public function updateSitePosition()
    {
        $officeIds =  request('officeIds');

        Office::whereIn('id', $officeIds)->each(function ($item) use ($officeIds) {
            $item->update([
                'site_position' => array_search($item->id, $officeIds) + 1
            ]);
        });
    }
}
