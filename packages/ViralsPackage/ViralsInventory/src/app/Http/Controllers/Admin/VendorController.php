<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use ViralsPackage\ViralsInventory\app\Http\Controllers\Controller;
use ViralsPackage\ViralsInventory\app\Http\Requests\CreateVendorRequest;
use ViralsPackage\ViralsInventory\app\Http\Requests\UpdateVendorRequest;
use ViralsPackage\ViralsInventory\app\Services\VendorService;

class VendorController extends Controller
{
    protected $vendorService; // the information we send to the view

    /**
     * Create a new controller instance.
     * @param VendorService $vendorSer
     */
    public function __construct(VendorService $vendorSer)
    {
        $this->middleware('auth');
        $this->vendorService = $vendorSer;
    }

    /**
     * Show the index vendor.
     *
     * @return Response
     */
    public function index()
    {
        $vendors = $this->vendorService->paginate(10);
        return view('virals-inventory::vendors.index', compact('vendors'));
    }

    /**
     * Show the create vendor.
     *
     * @return Response
     */
    public function create()
    {
        return view('virals-inventory::vendors.create');
    }

    /**
     * Store the new vendor.
     *
     * @return Response
     */
    public function store(CreateVendorRequest $request)
    {
        $request->merge(['created_by' => Auth::id()]);
        $vendor = $this->vendorService->create($request->except('_token'));
        return redirect()
                ->route('admin.vendors.index')
                ->with('success', __('virals-inventory::messages.create_message',
                            ['model' => __('virals-inventory::labels.vendor.index')]
                        ));
    }

    /**
     * Show the edit vendor.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        $vendor = $this->vendorService->findOrFail($id);
        return view('virals-inventory::vendors.edit', compact('vendor'));
    }

    /**
     * Update the vendor.
     *
     * @param UpdateVendorRequest $request
     * @param $id
     * @return Response
     */
    public function update(UpdateVendorRequest $request, $id)
    {
        $request->merge(['updated_by' => Auth::id()]);
        $vendor = $this->vendorService->update($request->except('_token'), $id);
        return redirect()
            ->route('admin.vendors.index')
            ->with('success', __('virals-inventory::messages.update_message',
                ['model' => __('virals-inventory::labels.vendor.index')]
            ));
    }

    /**
     * Show the vendor.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $vendor = $this->vendorService->findOrFail($id);
        return view('virals-inventory::vendors.show', compact('vendor'));
    }
}
