<?php

namespace App\Http\Controllers\PortfolioCategory;

use App\Http\Controllers\Controller;
use App\Service\PortfolioCategory\PortfolioCategoryService;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortfolioCategoryController extends Controller
{
    use GeneralTrait;
    private $pcategoryService;
    public function __construct(PortfolioCategoryService $pcategoryService)
    {
        $this->pcategoryService=$pcategoryService;
    }
    public function index(){
        $pcategory = $this->pcategoryService->index();
        return view('admin.pcategory.index',compact('pcategory'));
    }

    public function store(Request $request){
        try{
            $this->pcategoryService->store($request);
            return $this->SuccessMessage('portfoliocategories.index',' added' );
        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('portfoliocategories.create', $ex->getMessage());
        }
    }

    public function show($id){
        return $this->pcategoryService->show($id);
    }

    public function edit($id){
        $pcategory = $this->pcategoryService->edit($id);
        return view('admin.pcategory.edit',compact('pcategory'));
    }

    public function update(Request $request,$id){
        try{
            $this->pcategoryService->update($request,$id);
            return $this->SuccessMessage('portfoliocategories.index',' updated' );
        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('portfoliocategories.edit', $ex->getMessage());
        }
    }

    public function destroy($id){
        try{
            $this->pcategoryService->destroy($id);
            return $this->SuccessMessage('portfoliocategories.index',' deleted' );
        }catch(\Exception $ex){
            DB::rollback();
            return $this->ErrorMessage('portfoliocategories.index', $ex->getMessage());
        }
    }
}
