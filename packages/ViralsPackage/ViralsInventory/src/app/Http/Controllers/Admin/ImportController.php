<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use ViralsPackage\ViralsInventory\app\Http\Controllers\Controller;
use ViralsPackage\ViralsInventory\app\Http\Requests\CreateWarehouseRequest;
use ViralsPackage\ViralsInventory\app\Http\Requests\UpdateWarehouseRequest;
use ViralsPackage\ViralsInventory\app\Services\ImportService;

class ImportController extends Controller
{
    protected $importService; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct(ImportService $importService)
    {
        $this->middleware('auth');
        $this->importService = $importService;
    }

    /**
     * Show the index store.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imports = $this->importService->paginate(10);
        return view('virals-inventory::imports.index', compact('imports'));
    }

    /**
     * Show the create store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->importService->setupCreateData();
        return view('virals-inventory::imports.create', compact('data'));
    }

    public function store(CreateWarehouseRequest $request)
    {
        $request->merge(['created_by' => Auth::id()]);
        $warehouse = $this->warehouseService->create($request->except('_token'));
        return redirect()
            ->route('admin.warehouses.index')
            ->with('success', __('virals-inventory::messages.create_message',
                ['model' => __('virals-inventory::labels.warehouse')]
            ));
    }

    public function edit($id)
    {
        $import = $this->importService->findOrFail($id);
        $data = $this->importService->setupCreateData();
        return view('virals-inventory::imports.create', compact('data', 'import'));
    }

    public function update(UpdateWarehouseRequest $request, $id)
    {
        $request->merge(['updated_by' => Auth::id()]);
        $warehouse = $this->warehouseService->update($request->except('_token'), $id);
        return redirect()
            ->route('admin.warehouses.index')
            ->with('success', __('virals-inventory::messages.update_message',
                ['model' => __('virals-inventory::labels.warehouse')]
            ));
    }

    public function show($id)
    {
        $data = $this->setupCreateData->findOrFail($id);
        return view('virals-inventory::warehouses.show', compact('warehouse'));
    }
}
