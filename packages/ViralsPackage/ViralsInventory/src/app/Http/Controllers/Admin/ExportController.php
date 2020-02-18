<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use ViralsPackage\ViralsInventory\app\Http\Controllers\Controller;
use ViralsPackage\ViralsInventory\app\Http\Requests\CreateExportRequest;
use ViralsPackage\ViralsInventory\app\Models\Warehouse;
use ViralsPackage\ViralsInventory\app\Services\ExportService;
use PDF;

class ExportController extends Controller
{
    protected $exportService; // the information we send to the view

    /**
     * Create a new controller instance.
     * @param ExportService $exportSer
     */
    public function __construct(ExportService $exportSer)
    {
        $this->middleware('auth');
        $this->exportService = $exportSer;
    }

    /**
     * Show the index export.
     *
     * @return Response
     */
    public function index()
    {
        $exports = $this->exportService->paginate(10);

        return view('virals-inventory::exports.index', compact('exports'));
    }

    /**
     * Show the create export.
     *
     * @return Response
     */
    public function create()
    {
        $warehouse = Warehouse::all()->pluck('name', 'id');

        return view('virals-inventory::exports.create', compact('warehouse'));
    }

    /**
     * Store the new export.
     *
     * @param CreateExportRequest $request
     * @return Response
     */
    public function store(CreateExportRequest $request)
    {
        $request->merge(['created_by' => Auth::id()]);
        $request->merge(['date' => date('Y-m-d H:i:s', strtotime($request->date))]);
        $warehouse = $this->exportService->create($request->except('_token'));
        return redirect()
            ->route('admin.exports.index')
            ->with('success', __('virals-inventory::messages.create_message',
                ['model' => __('virals-inventory::labels.export.index')]
            ));
    }

    /**
     * Show the export.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $export = $this->exportService->findOrFail($id);
        $export->load('products', 'createdBy', 'updatedBy', 'warehouse');
        return view('virals-inventory::exports.show', compact('export'));
    }

    public function exportPdf($id)
    {
        $export = $this->exportService->findOrFail($id);
        $export->load('products', 'createdBy', 'updatedBy', 'warehouse');
        $pdf = PDF::loadView('virals-inventory::exports.pdf', compact('export'));
        return $pdf->download('export.pdf');
    }
}
