<?php

namespace App\Service\Portfolio;

use App\Repositories\Interfaces\RepositoryInterface;
use App\Repositories\PortfolioRepository;
use Illuminate\Http\Request;

class PortfolioService
{
    private $portfolioRepository;
    public function __construct(PortfolioRepository $portfolioRepository)
    {
        $this->portfolioRepository = $portfolioRepository;
    }
    public function index(){
        return $this->portfolioRepository->index();
    }

    public function create(){
        return $this->portfolioRepository->create();
    }

    public function store($request){
        return $this->portfolioRepository->store($request);
    }

    public function show(){
    }

    public function edit($portfolio){
        return $this->portfolioRepository->edit($portfolio);
    }

    public function update($request,$portfolio){
        return $this->portfolioRepository->update($request,$portfolio);
    }

    public function destroy($portfolio){
        return $this->portfolioRepository->destroy($portfolio);
    }
}
