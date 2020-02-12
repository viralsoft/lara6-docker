<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Admin;

use ViralsPackage\ViralsInventory\app\Http\Controllers\Controller;

class StoreController extends Controller
{
    protected $data = []; // the information we send to the view

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the index store.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('virals-inventory::stores.index');
    }

    /**
     * Show the create store.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('virals-inventory::stores.create');
    }
}
