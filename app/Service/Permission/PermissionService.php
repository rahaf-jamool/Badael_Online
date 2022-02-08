<?php

namespace App\Service\Permission;

use App\Manager\Permission\PermissionManager;
use App\Manager\Role\RoleManager;
use Illuminate\Http\Request;

class PermissionService
{
    private $permissionManager;
    public function __construct(PermissionManager $permissionManager)
    {
        $this->permissionManager=$permissionManager;
    }
    public function index()
    {
        return $this->permissionManager->index();
    }

    public function create(){
        return $this->permissionManager->create();
    }

    public function store(Request $request){
        return $this->permissionManager->store($request);
    }

    public function show($id){
        return $this->permissionManager->show($id);
    }

    public function edit($id){
        return $this->permissionManager->edit($id);
    }

    public function update(Request $request, $id){
        return $this->permissionManager->update($request, $id);
    }

    public function destroy($id){
        return $this->permissionManager->destroy($id);
    }
}
