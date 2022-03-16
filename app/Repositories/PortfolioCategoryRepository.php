<?php

namespace App\Repositories;

use App\Models\PortfolioCategory\Pcategory;
use App\Repositories\Interfaces\PortfolioCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PortfolioCategoryRepository implements PortfolioCategoryRepositoryInterface
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

    public function show()
    {
        //
    }

    public function edit($portfolioCategory)
    {
        return $this->portfolioCategory::findOrFail($portfolioCategory);
    }

    public function update($request,$portfolioCategory)
    {
        $portfolioCategory = $this->portfolioCategory::findOrFail($portfolioCategory);
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

    public function destroy($portfolioCategory)
    {
        $pcategory = $this->portfolioCategory::findOrFail($portfolioCategory);
        $pcategory->delete();
    }
}
