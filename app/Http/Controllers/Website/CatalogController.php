<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Filters\EquipmentFilter;
use App\Models\{Equipment, EquipmentCategory};

class CatalogController extends Controller
{

    /**
     * Catalog page
     *
     * @return View
     */
    public function index()
    {
        $equipmentCategories = EquipmentCategory::parentCategories()->get();

        return view('website.pages.catalog', compact('equipmentCategories'));
    }

    /**
     * Single category page.
     *
     * @param EquipmentFilter $filter
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function category(EquipmentCategory $equipmentCategory, EquipmentFilter $filter)
    {
        $filteredEquipment = Equipment::filter($filter)
            ->whereIn('id', $equipmentCategory->childEquipment->pluck('id'));

        $equipment = $filteredEquipment->paginate(8);
        $qtyWithPromotion = $filteredEquipment->whereIsSpecial(1)->count();

        if (request()->ajax()) {
            return view('website.equipment._equipment_items', compact('equipment'))->render();
        }

        return view('website.equipment.index', compact('equipmentCategory', 'equipment', 'qtyWithPromotion'));
    }

    /**
     * Show single equipment.
     *
     * @param Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function equipment(EquipmentCategory $equipmentCategory, Equipment $equipment)
    {
        return view('website.equipment.show', compact('equipment'));
    }
}
