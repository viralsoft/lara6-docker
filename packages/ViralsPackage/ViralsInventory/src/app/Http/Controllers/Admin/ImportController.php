<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use ViralsPackage\ViralsInventory\app\Http\Controllers\Controller;
use ViralsPackage\ViralsInventory\app\Http\Requests\CreateImportRequest;
use ViralsPackage\ViralsInventory\app\Services\ImportService;
use ViralsPackage\ViralsInventory\app\Services\ProductService;
use PDF;

class ImportController extends Controller
{
    protected $importService; // the information we send to the view
    protected $productService; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct(ImportService $importService, ProductService $productService)
    {
        $this->middleware('auth');
        $this->importService = $importService;
        $this->productService = $productService;
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
        return view('virals-inventory::imports.create', $data);
    }

    public function store(CreateImportRequest $request)
    {
        $request->merge(['created_by' => Auth::id()]);
        $request->merge(['date' => date('Y-m-d H:i:s', strtotime($request->date))]);
        $warehouse = $this->importService->create($request->except('_token'));
        return redirect()
            ->route('admin.imports.index')
            ->with('success', __('virals-inventory::messages.create_message',
                ['model' => __('virals-inventory::labels.imports')]
            ));
    }

    public function show($id)
    {
        $import = $this->importService->findOrFail($id);
        $import->load('products', 'createdBy', 'updatedBy', 'vendor', 'warehouse');
        return view('virals-inventory::imports.show', compact('import'));
    }

    public function exportPdf($id)
    {
        $import = $this->importService->findOrFail($id);
        $import->load('products', 'createdBy', 'updatedBy', 'vendor', 'warehouse');
        $pdf = PDF::loadView('virals-inventory::imports.pdf', compact('import'));
        return $pdf->download('import.pdf');
    }
}
