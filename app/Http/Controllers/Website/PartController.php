<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Filters\PartsFilter;
use App\Models\{Catalog, EquipmentGroup, Part};

class PartController extends Controller
{
    /**
     * Parts page.
     *
     * @param PartsFilter $filter
     * @return \Illuminate\Http\Response
     * @throws \Throwable
     */
    public function index(PartsFilter $filter)
    {
        $parts = Part::filter($filter)->paginate(20)->onEachSide(1);

        if (request()->ajax()) {
            return view('website.parts._parts_table', compact('parts'))->render();
        }

        $catalogs = Catalog::parentCatalogs()->orderBy('name')->get();
        $equipmentGroups = EquipmentGroup::all();

        return view('website.parts.index', compact('parts', 'catalogs', 'equipmentGroups'));
    }

    /**
     * Show single part.
     *
     * @param Part $part
     * @return \Illuminate\Http\Response
     */
    public function show(Part $part)
    {
        return view('website.parts.show', compact('part'));
    }
}
