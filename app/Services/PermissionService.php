<?php


namespace App\Services;

use App\Models\Permission;
use Illuminate\Support\Facades\Route;

class PermissionService
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function all()
    {
        return $this->permission->all();
    }

    public function getRoutePermissions()
    {
        $routeGroups = Route::getRoutes()->getRoutesByMethod();
        $permissionDatabases = $this->all();
        $permissions = [];
        $permissionsId = [];
        foreach ($routeGroups as $key => $routes) {
            if ($key != 'HEAD' & $key != 'OPTIONS') {
                foreach ($routes as $uri => $route) {
                    $permission['method'] = $key;
                    $permission['uri'] = $route->uri;
                    $checkPermission = $permissionDatabases->where('method', $key)->where('uri', $route->uri)->first();
                    if ($checkPermission) {
                        $permission['name'] = $checkPermission->name;
                        $permission['id'] = $checkPermission->id;
                        $permissionsId[] = $checkPermission->id;
                    } else {
                        $permission['id'] = '';
                        $permission['name'] = '';
                    }
                    $permission['status'] = true;
                    $permissions[] = $permission;
                }
            }
        }
        $deleteRoute = $this->permission->whereNotIn('id', $permissionsId)->get();
        foreach ($deleteRoute as $route) {
            $permission['method'] = $route->method;
            $permission['uri'] = $route->uri;
            $permission['name'] = $route->name;
            $permission['id'] = $route->id;
            $permission['status'] = false;
            $permissions[] = $permission;
        }
        return $permissions;
    }

    public function create($data)
    {
        return $this->permission->create($data);
    }

    public function findByUriAndMethod($method, $uri)
    {
        return $this->permission->where('method', $method)->where('uri', $uri)->first();
    }

    public function delete($id)
    {
        $permission = $this->permission->find($id);
        $permission->delete();
    }
}