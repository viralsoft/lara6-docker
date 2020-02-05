<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        parent::__construct();
        $this->permissionService = $permissionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permissionService->getRoutePermissions();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function validate_index()
    {
        if(Auth::user()->email != 'admin@viralsoft.vn') {
            abort('403');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = $this->permissionService->findByUriAndMethod($request->input('method'), $request->input('uri'));
        if ($permission) {
            $permission->update(['name' => $request->name]);
        } else {
            $permission = $this->permissionService->create($request->except('_token'));
        }
        return response()->json($permission->toArray());
    }

    public function validate_store()
    {
        if(Auth::user()->email != 'admin@viralsoft.vn') {
            abort('403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->permissionService->delete($id);
    }

    public function validate_destroy()
    {
        if(Auth::user()->email != 'admin@viralsoft.vn') {
            abort('403');
        }
    }
}
