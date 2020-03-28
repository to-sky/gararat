<?php

namespace App\Http\Controllers\Secured;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;
use App\Models\{
    Unit, UnitPart, Catalog, Equipment, Part
};
use App\Services\MediaService;
use Illuminate\Support\Facades\Cache;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipmentUnits = Unit::with(['equipment', 'catalog'])->get()
            ->sortBy('equipment.site_position')
            ->groupBy('equipment_id');

        $collapsedCards = Cache::get('collapseUnitsState');

        return view('admin.unit.index', compact('equipmentUnits', 'collapsedCards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unit.create', [
            'parentCatalogs' => Catalog::parentCatalogs()->with('childs')->get(),
            'equipment' => Equipment::all()
        ]);
    }

    /**
     * Get parts and render into modal table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getParts()
    {
        $parts = Part::all()->map->only(['id', 'name', 'producer_id']);

        // Exclude parts if part exists on the form
        if ($excludePartIds = request('excludePartIds')) {
            $parts = $parts->whereNotIn('id', $excludePartIds);
        }

        return view('admin.unit.includes._parts-table', compact('parts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UnitRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UnitRequest $request)
    {
        collect($request->equipment_id)->each(function ($equipmentId) use ($request) {
            $unit = Unit::firstOrCreate([
                'equipment_id' => $equipmentId,
                'catalog_id' => $request->catalog_id
            ]);

            $this->updateOrCreateUnitParts($unit, $request->parts);
        });

        return redirect()->route('admin.unit.index');
    }

    /**
     * Update or create unit parts
     *
     * @param Unit $unit
     * @param array $parts
     * @return bool|null
     */
    private function updateOrCreateUnitParts(Unit $unit, array $parts)
    {
        if (empty($parts)) return null;

        foreach ($parts as $part) {
            $unitPartData = [
                'unit_id' => $unit->id,
                'part_id' => $part['part_id']
            ];

            UnitPart::updateOrCreate($unitPartData, $unitPartData + [
                'qty' => $part['qty'] ?? 0
            ]);
        }

        return true;
    }

    /**
     * Save collapse state for show units (collapsed or no)
     */
    public function collapseUnitsState()
    {
       Cache::put('collapseUnitsState', request()->collapseState);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Unit $unit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UnitRequest $request
     * @param Unit $unit
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        $requestPartIds = array_column($request->parts, 'part_id');

        // Delete parts which no in request
        $unit->unitParts->whereNotIn('part_id', $requestPartIds)->each->delete();

        // Update old unit parts and create new unit parts
        $this->updateOrCreateUnitParts($unit, $request->parts);

        // Store figure
        MediaService::store($unit, ['figure']);

        return redirect()->route('admin.unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Unit $unit
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('admin.unit.index');
    }
}
