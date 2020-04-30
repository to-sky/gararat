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

        // TODO: remove hardcode
        $equipment = $equipment->map(function ($item) {
            if ($item->id == 505 || $item->id == 503) {
                $item->short_description = [
                    0 => 'Capacity, h.p./kW 81,6/60',
                    1 => 'Axle arrangement 4x2',
                ];

                $item->short_description_ar = [
                    0 => 'ت إلى سلة التسوق.',
                    1 => 'ت إلى سلة التسوق.',
                ];

                return $item;
            }

            $item->short_description = [
                0 => 'Capacity, h.p./kW 81,6/60',
                1 => 'Axle arrangement 4x2',
                2 => 'Lorem ipsum dolor set ament'
            ];

            $item->short_description_ar = [
                0 => 'ت إلى سلة التسوق.',
                1 => 'ت إلى سلة التسوق.',
                2 => 'ت إلى سلة التسوق.'
            ];

            return $item;
        });

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
