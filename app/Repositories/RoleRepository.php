<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleRepository implements RepositoryInterface{

    private $role;
    private $permission;
    public function __construct(Role $role,Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        return $this->role->all();
    }

    public function create()
    {
        return $this->permission->all();
    }

    public function store(Request $request)
    {
        $slug= $request->name;

        DB::beginTransaction();

        $role=Role::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        if ($request->has('permissions')) {
            $perm = Role::find($role->id);
            $perm->permissions()->syncWithoutDetaching($request->get('permissions'));
        }
        DB::commit();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.role.edit',compact('role','permissions'));
    }

    public function update(Request $request, $id)
    {
        $slug= $request->name;

        $role = Role::find($id);

        DB::beginTransaction();

        $role->where('roles.id',$id)->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        if ($request->has('permissions')) {
            $perm = Role::find($role->id);
            $perm->permissions()->syncWithoutDetaching($request->get('permissions'));
        }
        DB::commit();
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

    }
}
