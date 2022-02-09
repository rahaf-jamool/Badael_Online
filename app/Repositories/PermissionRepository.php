<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionRepository implements RepositoryInterface{

    private $permission;
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function index()
    {
        return $this->permission::all();
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $slug= $request->name;

        DB::beginTransaction();

        $this->permission::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        DB::commit();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->permission::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $slug= $request->name;

        $permission = $this->permission::find($id);

        DB::beginTransaction();

        $permission->where('permissions.id',$id)->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        DB::commit();
    }

    public function destroy($id)
    {
        $permission = $this->permission::findOrFail($id);

        $permission->delete();
    }

}
