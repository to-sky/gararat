<?php

namespace App\Http\Controllers\Secured;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentGroupRequest;
use App\Models\EquipmentGroup;

class EquipmentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.equipment-group.index', [
            'equipmentGroups' => EquipmentGroup::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.equipment-group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EquipmentGroupRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentGroupRequest $request)
    {
        EquipmentGroup::create($request->all());

        return redirect()->route('admin.equipment-group.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EquipmentGroup  $equipmentGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentGroup $equipmentGroup)
    {
        return view('admin.equipment-group.edit', compact('equipmentGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EquipmentGroupRequest $request
     * @param  \App\Models\EquipmentGroup $equipmentGroup
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentGroupRequest $request, EquipmentGroup $equipmentGroup)
    {
        $equipmentGroup->update($request->all());

        return redirect()->route('admin.equipment-group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EquipmentGroup $equipmentGroup
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(EquipmentGroup $equipmentGroup)
    {
        $equipmentGroup->delete();

        return redirect()->route('admin.equipment-group.index');
    }
}
