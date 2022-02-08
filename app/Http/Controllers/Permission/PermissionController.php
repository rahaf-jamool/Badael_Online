<?php

namespace App\Http\Controllers\Permission;

use App\Models\Permission;
use App\Service\Permission\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;


class PermissionController extends Controller
{
    private $permissionService;
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService=$permissionService;
    }

    public function index()
    {
        $permissions = $this->permissionService->index();
        return view('admin.permission.index',compact('permissions'));
    }

    public function create()
    {
        $this->permissionService->create();
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        try{

            $this->permissionService->store($request);
            return redirect()->route('admin.permission')->with('success', 'Data added successfully');

        }catch(\Exception $ex){
            return $ex->getMessage();
            return redirect()->route('admin.permission.create')->with('error', 'Data failed to add');
        }
    }

    public function show($id)
    {
        return $this->permissionService->show($id);
    }

    public function edit($id)
    {
        $permission = $this->permissionService->edit($id);
        return view('admin.permission.edit',compact('permission'));
    }

    public function update(Request $request, $id)
    {
        try{

            $this->permissionService->update($request,$id);
            return redirect()->route('admin.permission')->with('success', 'Data added successfully');

        }catch(\Exception $ex){
            return $ex->getMessage();
            return redirect()->route('admin.permission.create')->with('error', 'Data failed to add');
        }
    }

    public function destroy($id){
        try{
            $this->permissionService->destroy($id);
            return redirect()->route('admin.permission')->with('success', 'Data deleted successfully');

        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.permission')->with('error', 'Data deleted failed');
        }
    }
}
