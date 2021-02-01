<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentRequest;
use App\Models\{
    Equipment, EquipmentGroup, Manufacturer
};
use Exception;
use Illuminate\Http\Response;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
     * @return Response
     */
    public function create()
    {
        $this->generateParams();

        $sitePosition = Equipment::getLastSitePosition() + 1;

        return view('admin.equipment.create', compact('sitePosition'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EquipmentRequest $request
     * @return Response
     */
    public function store(EquipmentRequest $request)
    {
        Equipment::create($request->all());

        return redirect()->route('admin.equipment.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Equipment $equipment
     * @return Response
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
     * @param Equipment $equipment
     * @return Response
     */
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update($request->all());

        return redirect()->route('admin.equipment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Equipment $equipment
     * @return Response
     * @throws Exception
     */
    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return back();
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
     * Clone equipment
     *
     * @param Equipment $equipment
     * @return bool
     */
    public function cloneEquipment(Equipment $equipment)
    {
        $cloneEquipment = $equipment->replicate();
        $cloneEquipment->name = $equipment->name . '_2';
        $cloneEquipment->name_ar = $equipment->name_ar . '_2';
        $cloneEquipment->slug = $equipment->slug . '_2';
        $cloneEquipment->site_position = Equipment::getLastSitePosition() + 1;
        $cloneEquipment->save();

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
