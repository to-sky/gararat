<?php

namespace App\Http\Controllers\Secured;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentRequest;
use App\Models\{
    Equipment, EquipmentGroup, Manufacturer
};

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.equipment.index', [
            'equipment' => Equipment::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->generateParams();

        $sitePosition = Equipment::all()->count() + 1;

        return view('admin.equipment.create', compact('sitePosition'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EquipmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentRequest $request)
    {
        Equipment::create($request->all());

        return redirect()->route('admin.equipment.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        $this->generateParams();

        return view('admin.equipment.edit', compact('equipment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EquipmentRequest $request
     * @param  \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update($request->all());

        return redirect()->route('admin.equipment.index');
    }

    /**
     * Update site position after Drag'n'Drop on the table
     */
    public function updateSitePosition()
    {
        $equipmentIds =  request('equipmentIds');

        Equipment::whereIn('id', $equipmentIds)->each(function ($item) use ($equipmentIds) {
            $item->update([
                'site_position' => array_search($item->id, $equipmentIds) + 1
            ]);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment $equipment
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('admin.equipment.index');
    }

    /**
     * Share the same variables for different views
     */
    public function generateParams()
    {
        $manufacturers =  Manufacturer::all();
        $equipmentGroups = EquipmentGroup::all();

        view()->share('manufacturers', $manufacturers);
        view()->share('equipmentGroups', $equipmentGroups);
    }
}
