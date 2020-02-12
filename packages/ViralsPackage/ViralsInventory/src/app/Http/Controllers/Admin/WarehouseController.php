<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use ViralsPackage\ViralsInventory\app\Http\Controllers\Controller;
use ViralsPackage\ViralsInventory\app\Http\Requests\CreateWarehouseRequest;
use ViralsPackage\ViralsInventory\app\Http\Requests\UpdateWarehouseRequest;
use ViralsPackage\ViralsInventory\app\Services\StoreService;
use ViralsPackage\ViralsInventory\app\Services\WarehouseService;

class WarehouseController extends Controller
{
    protected $warehouseService; // the information we send to the view
    protected $storeService; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct(WarehouseService $warehouseService, StoreService $storeService)
    {
        $this->middleware('auth');
        $this->warehouseService = $warehouseService;
        $this->storeService = $storeService;
    }

    /**
     * Show the index store.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = $this->warehouseService->paginate(10);
        return view('virals-inventory::warehouses.index', compact('warehouses'));
    }

    /**
     * Show the create store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = $this->storeService->all()->pluck('name', 'id')->toArray();
        return view('virals-inventory::warehouses.create', compact('stores'));
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
        $warehouse = $this->warehouseService->findOrFail($id);
        $stores = $this->storeService->all()->pluck('name', 'id')->toArray();
        return view('virals-inventory::warehouses.edit', compact('stores', 'warehouse'));
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
        $warehouse = $this->warehouseService->findOrFail($id);
        return view('virals-inventory::warehouses.show', compact('warehouse'));
    }
}
