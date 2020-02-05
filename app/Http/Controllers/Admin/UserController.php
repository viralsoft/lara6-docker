<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * @var PermissionService
     * @var RoleService
     */
    protected $permissionService;
    protected $roleService;
    protected $userService;

    public function __construct(RoleService $roleService, PermissionService $permissionService, UserService $userService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
        $this->userService = $userService;
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissionService->all();
        $roles = $this->roleService->all();
        return view('admin.users.create', compact('permissions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissions = $this->permissionService->all();
        $roles = $this->roleService->all();
        $user = $this->userService->find($id);
        $permissionUser = $this->roleService->findRoles($user->roles->pluck('id')->toArray());
        $collection = collect($permissionUser);

        $collapseUser = array_unique($collection->collapse()->toArray());
        return view('admin.users.edit', compact('permissions', 'roles', 'user', 'collapseUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $this->userService->update($request->all());
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showPermission(Request $request)
    {
        $collapsed = [];
        if($request->has('roles')) {
            $permissions = $this->roleService->findRoles($request->roles);
            $collection = collect($permissions);

            $collapsed = $collection->collapse()->toArray();
        }
        return response()->json(array_unique($collapsed));
    }
}
