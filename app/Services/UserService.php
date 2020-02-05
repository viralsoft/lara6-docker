<?php


namespace App\Services;

use App\User;

class UserService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->with('permissions', 'roles')->get();
    }

    public function create($data)
    {
       $roles = $this->user->create(['name' => $data['name']]);
        $roles->permissions()->attach($data['permissions']);
        return $roles;
    }

    public function find($id)
    {
        return $this->user->with('permissions', 'roles')->findOrFail($id);
    }

    public function update($data)
    {
        $users = $this->user->with('permissions', 'roles')->find($data['id']);
        $users->update(['name' => $data['name']]);
        $users->permissions()->detach();
        if (array_key_exists('permissions', $data)) {
            $users->permissions()->attach($data['permissions']);
        }
        $users->roles()->detach();
        $users->roles()->attach($data['roles']);
        return $users;
    }

    public function destroy($id)
    {
        $roles = $this->user->with('permissions')->find($id);
        $roles->permissions()->detach();
        $roles->delete();
    }
}