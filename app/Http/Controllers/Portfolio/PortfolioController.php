<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Service\Portfolio\PortfolioService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class PortfolioController extends Controller
{
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

    public function store(Request $request){
        try{
            $this->portfolioService->store($request);
            return redirect()->route('admin.portfolio')->with('success', 'Data added successfully');

        }catch(\Exception $ex){
            DB::rollback();
            // return $ex->getMessage();
            return redirect()->route('admin.portfolio.create')->with('error', 'Data failed to add');
        }
    }

    public function show($id){
        return $this->portfolioService->show($id);
    }

    public function edit($id){
        return $this->portfolioService->edit($id);
    }

    public function update(Request $request,$id){
        try{
            return $this->portfolioService->update($request,$id);
            return redirect()->route('admin.portfolio')->with('success', 'Data updated successfully');

        }catch(\Exception $ex){
            DB::rollback();
            // return $ex->getMessage();
            return redirect()->route('admin.portfolio.edit')->with('error', 'Data failed to update');
        }
    }

    public function destroy($id){
        try{
            $this->portfolioService->destroy($id);
            return redirect()->route('admin.portfolio')->with('success', 'Data deleted successfully');

        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.portfolio')->with('error', 'Data deleted failed');
        }
    }
}
