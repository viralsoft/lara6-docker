<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use ViralsPackage\ViralsInventory\app\Http\Controllers\Controller;
use ViralsPackage\ViralsInventory\app\Http\Requests\CreateStoreRequest;
use ViralsPackage\ViralsInventory\app\Services\StoreService;

class StoreController extends Controller
{
    protected $storeService; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct(StoreService $storeService)
    {
        $this->middleware('auth');
        $this->storeService = $storeService;
    }

    /**
     * Show the index store.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = $this->storeService->paginate(10);
        return view('virals-inventory::stores.index', compact('stores'));
    }

    /**
     * Show the create store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->pluck('name', 'id')->toArray();
        return view('virals-inventory::stores.create', compact('users'));
    }

    public function store(CreateStoreRequest $request)
    {
        $request->merge(['created_by' => Auth::id()]);
        $store = $this->storeService->create($request->except('_token'));
        return redirect()
                ->route('admin.stores.index')
                ->with('success', __('virals-inventory::messages.create_message',
                            ['model' => __('virals-inventory::labels.store')]
                        ));
    }

    public function edit($id)
    {
        $store = $this->storeService->findOrFail($id);
        $users = User::all()->pluck('name', 'id')->toArray();
        return view('virals-inventory::stores.edit', compact('users', 'store'));
    }

    public function update(CreateStoreRequest $request, $id)
    {
        $request->merge(['updated_by' => Auth::id()]);
        $store = $this->storeService->update($request->except('_token'), $id);
        return redirect()
            ->route('admin.stores.index')
            ->with('success', __('virals-inventory::messages.update_message',
                ['model' => __('virals-inventory::labels.store')]
            ));
    }

    public function show($id)
    {
        $store = $this->storeService->findOrFail($id);
        return view('virals-inventory::stores.show', compact('store'));
    }
}
