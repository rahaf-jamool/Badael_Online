<?php

namespace App\Manager\Permission;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Http\Request;

class PermissionManager
{
    private $repository;
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository=$repository;
    }

    public function index(){
        return $this->repository->index();
    }

    public function create(){
        return $this->repository->create();
    }

    public function store(Request $request){
        return $this->repository->store($request);
    }

    public function show($id){
        return $this->repository->show($id);
    }

    public function edit($id){
        return $this->repository->edit($id);
    }

    public function update(Request $request, $id){
        return $this->repository->update($request,$id);
    }

    public function destroy($id){
        return $this->repository->destroy($id);
    }
}
