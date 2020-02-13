<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Admin;

use ViralsPackage\ViralsInventory\app\Http\Controllers\Controller;
use ViralsPackage\ViralsInventory\app\Http\Requests\CreateUnitRequest;
use ViralsPackage\ViralsInventory\app\Http\Requests\UpdateUnitRequest;
use ViralsPackage\ViralsInventory\app\Services\UnitService;

class UnitController extends Controller
{
    protected $unitService; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct(UnitService $unitService)
    {
        $this->middleware('auth');
        $this->unitService = $unitService;
    }

    /**
     * Show the index unit.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = $this->unitService->paginate(10);
        return view('virals-inventory::units.index', compact('units'));
    }

    /**
     * Show the create unit.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('virals-inventory::units.create');
    }

    public function store(CreateUnitRequest $request)
    {
        $unit = $this->unitService->create($request->except('_token'));
        return redirect()
                ->route('admin.units.index')
                ->with('success', __('virals-inventory::messages.create_message',
                            ['model' => __('virals-inventory::labels.unit')]
                        ));
    }

    public function edit($id)
    {
        $unit = $this->unitService->findOrFail($id);
        return view('virals-inventory::units.edit', compact('unit'));
    }

    public function update(UpdateUnitRequest $request, $id)
    {
        $unit = $this->unitService->update($request->except('_token'), $id);
        return redirect()
            ->route('admin.units.index')
            ->with('success', __('virals-inventory::messages.update_message',
                ['model' => __('virals-inventory::labels.unit')]
            ));
    }

    public function show($id)
    {
        $unit = $this->unitService->findOrFail($id);
        return view('virals-inventory::units.show', compact('unit'));
    }
}
