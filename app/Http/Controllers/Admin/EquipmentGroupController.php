<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentGroupRequest;
use App\Models\EquipmentGroup;
use Exception;
use Illuminate\Http\Response;

class EquipmentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.equipment-groups.index', [
            'equipmentGroups' => EquipmentGroup::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.equipment-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EquipmentGroupRequest $request
     * @return Response
     */
    public function store(EquipmentGroupRequest $request)
    {
        EquipmentGroup::create($request->all());

        return redirect()->route('admin.equipment-groups.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EquipmentGroup $equipmentGroup
     * @return Response
     */
    public function edit(EquipmentGroup $equipmentGroup)
    {
        return view('admin.equipment-groups.edit', compact('equipmentGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EquipmentGroupRequest $request
     * @param EquipmentGroup $equipmentGroup
     * @return Response
     */
    public function update(EquipmentGroupRequest $request, EquipmentGroup $equipmentGroup)
    {
        $equipmentGroup->update($request->all());

        return redirect()->to($request->previous_page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EquipmentGroup $equipmentGroup
     * @return Response
     * @throws Exception
     */
    public function destroy(EquipmentGroup $equipmentGroup)
    {
        $equipmentGroup->delete();

        return back();
    }
}
