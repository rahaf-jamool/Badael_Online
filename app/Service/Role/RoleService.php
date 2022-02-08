<?php

namespace App\Service\Role;

use App\Manager\Role\RoleManager;
use Illuminate\Http\Request;

class RoleService
{
    private $roleManager;
    public function __construct(RoleManager $roleManager)
    {
        $this->roleManager=$roleManager;
    }
    public function index()
    {
        return $this->roleManager->index();
    }

    public function create(){
        return $this->roleManager->create();
    }

    public function store(Request $request){
        return $this->roleManager->store($request);
    }

    public function show($id){
        return $this->roleManager->show($id);
    }

    public function edit($id){
        return $this->roleManager->edit($id);
    }

    public function update(Request $request, $id){
        return $this->roleManager->update($request, $id);
    }

    public function destroy($id){
        return $this->roleManager->destroy($id);
    }
}
