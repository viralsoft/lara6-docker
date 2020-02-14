<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use ViralsPackage\ViralsInventory\app\Http\Controllers\Controller;
use ViralsPackage\ViralsInventory\app\Http\Requests\ProductRequest;
use ViralsPackage\ViralsInventory\app\Services\ProductService;

class ProductController extends Controller
{
    protected $productService; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct(ProductService $productService)
    {
        $this->middleware('auth');
        $this->productService = $productService;
    }

    /**
     * Show the index store.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->paginate(10);

        return view('virals-inventory::products.index', compact('products'));
    }

    /**
     * Show the create store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = $this->productService->getUnits()->pluck('name', 'id')->toArray();

        return view('virals-inventory::products.form', compact('units'));
    }

    public function store(ProductRequest $request)
    {
        $request->merge(['created_by' => Auth::id()]);
        $this->productService->create($request->except('_token'));
        return redirect()
                ->route('admin.products.index')
                ->with('success', __('virals-inventory::messages.create_message',
                            ['model' => __('virals-inventory::labels.product')]
                        ));
    }

    public function edit($id)
    {
        $product = $this->productService->findOrFail($id);
        $units = $this->productService->getUnits()->pluck('name', 'id')->toArray();

        return view('virals-inventory::products.form', compact('product', 'units'));
    }

    public function update(ProductRequest $request, $id)
    {
        $request->merge(['updated_by' => Auth::id()]);
        $this->productService->update($request->except('_token'), $id);

        return redirect()
            ->route('admin.products.index')
            ->with('success', __('virals-inventory::messages.update_message',
                ['model' => __('virals-inventory::labels.product')]
            ));
    }

    public function show($id)
    {
        $product = $this->productService->findOrFail($id);

        return view('virals-inventory::products.show', compact('product'));
    }
}
