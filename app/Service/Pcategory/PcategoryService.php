<?php

namespace App\Service\Pcategory;

use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Http\Request;

class  PcategoryService
{
    private $repositoryInterface;
    public function __construct(RepositoryInterface $repositoryInterface)
    {
        $this->repositoryInterface = $repositoryInterface;
    }
    public function index(){
        return $this->repositoryInterface->index();
    }

    public function store(Request $request){
        return $this->repositoryInterface->store($request);
    }

    public function show($id){
        return $this->repositoryInterface->show($id);
    }

    public function edit($id){
        return $this->repositoryInterface->edit($id);
    }

    public function update(Request $request,$id){
        return $this->repositoryInterface->update($request,$id);
    }

    public function destroy($id){
        return $this->repositoryInterface->destroy($id);
    }
}
