<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Filters\EquipmentFilter;
use App\Models\{Equipment, EquipmentCategory};

class EquipmentController extends Controller
{
    /**
     * Equipment page.
     *
     * @param EquipmentFilter $filter
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index(EquipmentFilter $filter)
    {
        $filteredEquipment = Equipment::filter($filter);
        $equipment = $filteredEquipment->paginate(8);

        if (request()->ajax()) {
            return view('website.equipment._equipment_items', compact('equipment'))->render();
        }

        $manufacturers = Manufacturer::all();
        $qtyWithPromotion = $filteredEquipment->whereIsSpecial(1)->count();

        return view('website.equipment.index', compact('equipment', 'manufacturers', 'qtyWithPromotion'));
    }

    /**
     * Show single equipment.
     *
     * @param Equipment $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        return view('website.equipment.show', compact('equipment'));
    }
}
