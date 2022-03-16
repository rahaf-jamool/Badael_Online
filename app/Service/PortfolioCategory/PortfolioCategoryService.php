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

    public function edit($portfolioCategory){
        return $this->pcategoryRepository->edit($portfolioCategory);
    }

    public function update($request,$portfolioCategory){
        return $this->pcategoryRepository->update($request,$portfolioCategory);
    }

    public function destroy($portfolioCategory){
        return $this->pcategoryRepository->destroy($portfolioCategory);
    }
}
