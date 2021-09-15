<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipmentCategoryRequest;
use App\Models\EquipmentCategory;
use Exception;
use Illuminate\Http\Response;

class EquipmentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.equipment-categories.index', [
            'equipmentCategories' => EquipmentCategory::parentCategories()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.equipment-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EquipmentCategoryRequest $request
     * @return Response
     */
    public function store(EquipmentCategoryRequest $request)
    {
        $equipmentCategory = EquipmentCategory::create($request->all());
        $equipmentCategory->updateOrCreateSubcategories($request->subcategories);

        return redirect()->route('admin.equipment-categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EquipmentCategory $equipmentCategory
     * @return Response
     */
    public function edit(EquipmentCategory $equipmentCategory)
    {
        return view('admin.equipment-categories.edit', compact('equipmentCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EquipmentCategoryRequest $request
     * @param EquipmentCategory $equipmentCategory
     * @return Response
     */
    public function update(EquipmentCategoryRequest $request, EquipmentCategory $equipmentCategory)
    {
        $equipmentCategory->update($request->all());
        $equipmentCategory->updateOrCreateSubcategories($request->subcategories);

        return redirect()->to($request->previous_page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EquipmentCategory $equipmentCategory
     * @return Response
     * @throws Exception
     */
    public function destroy(EquipmentCategory $equipmentCategory)
    {
        $equipmentCategory->delete();

        return request()->ajax() ? response(['success' => true]) : back();
    }

    /**
     * Update site position after Drag'n'Drop on the table
     */
    public function updateSitePosition()
    {
        $equipmentCategoryIds = request('equipmentCategoryIds');

        EquipmentCategory::whereIn('id', $equipmentCategoryIds)->each(function ($item) use ($equipmentCategoryIds) {
            $item->update([
                'site_position' => array_search($item->id, $equipmentCategoryIds) + 1
            ]);
        });
    }
}
