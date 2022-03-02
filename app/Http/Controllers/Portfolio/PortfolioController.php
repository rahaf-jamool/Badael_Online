<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\PortfolioRequest;
use App\Service\Portfolio\PortfolioService;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    use GeneralTrait;
    private $portfolioService;
    public function __construct(PortfolioService $portfolioService)
    {
        $this->portfolioService=$portfolioService;
    }

    public function index(){
        $portfolio = $this->portfolioService->index();
        return view('admin.portfolio.index',compact('portfolio'));
    }

    public function create(){
        $categories = $this->portfolioService->create();
        return view('admin.portfolio.create',compact('categories'));
    }

    public function store(PortfolioRequest $request){
        try{

            $this->portfolioService->store($request);
            return $this->SuccessMessage('portfolios.index',' added' );
        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('portfolios.create', $ex->getMessage());
        }
    }

    public function show($id){
        return $this->portfolioService->show($id);
    }

    public function edit($id){
        $portfolio = $this->portfolioService->edit($id);
        $categories = $this->portfolioService->create();
        return view('admin.portfolio.edit',compact('portfolio','categories'));
    }

    public function update(PortfolioRequest $request,$id){
        try{
            $this->portfolioService->update($request,$id);
            return $this->SuccessMessage('portfolios.index',' updated' );
        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('portfolios.edit', $ex->getMessage());
        }
    }

    public function destroy($id){
        try{
            $this->portfolioService->destroy($id);
            return $this->SuccessMessage('portfolios.index',' deleted' );

        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('portfolios.index', $ex->getMessage());
        }
    }
}
