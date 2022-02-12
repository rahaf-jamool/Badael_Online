<?php

namespace App\Http\Controllers\Pcategory;

use App\Http\Controllers\Controller;
use App\Service\Pcategory\PcategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PCategoryController extends Controller
{
    private $pcategoryService;
    public function __construct(PcategoryService $pcategoryService)
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
            return redirect()->route('admin.pcategory')->with('success', 'Data added successfully');

        }catch(\Exception $ex){
            DB::rollback();
            // return $ex->getMessage();
            return redirect()->route('admin.pcategory')->with('error', 'Data failed to add');
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
            return redirect()->route('admin.pcategory')->with('success', 'Data updated successfully');
        }catch(\Exception $ex){
            DB::rollback();
            // return $ex->getMessage();
            return redirect()->route('admin.pcategory.create')->with('error', 'Data failed to update');
        }
    }

    public function destroy($id){
        try{
            $this->pcategoryService->destroy($id);
            return redirect()->route('admin.pcategory')->with('success', 'Data deleted successfully');

        }catch(\Exception $ex){
            DB::rollback();
            return $ex->getMessage();
            return redirect()->route('admin.pcategory')->with('error', 'Data deleted failed');
        }
    }
}
