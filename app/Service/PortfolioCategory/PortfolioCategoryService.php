<?php

namespace App\Service\PortfolioCategory;

use App\Repositories\PortfolioCategoryRepository;

class PortfolioCategoryService
{
    private $pcategoryRepository;
    public function __construct(PortfolioCategoryRepository $pcategoryRepository)
    {
        $this->pcategoryRepository = $pcategoryRepository;
    }
    public function index(){
        return $this->pcategoryRepository->index();
    }

    public function store($request){
        return $this->pcategoryRepository->store($request);
    }

    public function show($id){
        return $this->pcategoryRepository->show($id);
    }

    public function edit($id){
        return $this->pcategoryRepository->edit($id);
    }

    public function update($request,$id){
        return $this->pcategoryRepository->update($request,$id);
    }

    public function destroy($id){
        return $this->pcategoryRepository->destroy($id);
    }
}
