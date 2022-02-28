<?php

namespace App\Repositories;

use App\Models\PortfolioCategory\Pcategory;
use Illuminate\Support\Facades\DB;

class PortfolioCategoryRepository implements Interfaces\RepositoryInterface
{
    private $portfolioCategory;
    public function __construct(Pcategory $portfolioCategory)
    {
        $this->portfolioCategory = $portfolioCategory;
    }

    public function index()
    {
        return $this->portfolioCategory->orderBy('id','desc')->get();
    }

    public function create()
    {

    }

    public function store($request)
    {
        DB::beginTransaction();
        $data = [
            'en' => [
                'name' => $request->input('en_name')
            ],
            'ar' => [
                'name' => $request->input('ar_name')
            ],
        ];
        $this->portfolioCategory->create($data);
        DB::commit();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->portfolioCategory::findOrFail($id);
    }

    public function update($request,$id)
    {
        $portfolioCategory = $this->portfolioCategory::findOrFail($id);
        DB::beginTransaction();
        $data = [
            'en' => [
                'name' => $request->input('en_name')
            ],
            'ar' => [
                'name' => $request->input('ar_name')
            ],
        ];
        $portfolioCategory->update($data);
        DB::commit();
    }

    public function destroy($id)
    {
        $pcategory = $this->portfolioCategory::findOrFail($id);
        $pcategory->delete();
    }
}
