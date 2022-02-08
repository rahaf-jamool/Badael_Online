<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Service\Role\RoleService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService=$roleService;
    }

    public function index()
    {
        $roles = $this->roleService->index();
        return view('admin.role.index',compact('roles'));
    }

    public function create()
    {
        $permissions = $this->roleService->create();
        return view('admin.role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        try{

            $this->roleService->store($request);
            return redirect()->route('admin.role')->with('success', 'Data added successfully');

        }catch(\Exception $ex){

            return $ex->getMessage();
            return redirect()->route('admin.role.create')->with('error', 'Data failed to add');
        }
    }

    public function show($id)
    {
       return $this->roleService->show($id);

    }

    public function edit($id)
    {
       return $this->roleService->edit($id);
    }

    public function update(Request $request, $id)
    {
        try{

            $this->roleService->update($request,$id);
            return redirect()->route('admin.role')->with('success', 'Data added successfully');

        }catch(\Exception $ex){

            return $ex->getMessage();
            return redirect()->route('admin.role.edit')->with('error', 'Data failed to update');
        }
    }

    public function destroy($id)
    {
        try{
            $this->roleService->destroy($id);
            return redirect()->route('admin.role')->with('success', 'Data deleted successfully');

        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.role')->with('error', 'Data deleted failed');
        }
    }
}
