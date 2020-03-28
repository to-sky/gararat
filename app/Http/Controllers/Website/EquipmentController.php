<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Filters\EquipmentFilter;
use App\Models\{Equipment, Manufacturer};

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
        $equipment = Equipment::filter($filter)->get();

        if (request()->ajax()) {
            return view('website.equipment._equipment_items', compact('equipment'))->render();
        }

        $manufacturers = Manufacturer::all();

        return view('website.equipment.index', compact('equipment', 'manufacturers'));
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
