<?php

namespace App\Repositories;

use App\Models\Portfolio\Portfolio;
use App\Models\PortfolioCategory\PortfolioCategory;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PortfolioRepository implements PortfolioRepositoryInterface {

    private $portfolio;
    private $portfolioCategory;
    public function __construct(Portfolio $portfolio,PortfolioCategory $portfolioCategory)
    {
        $this->portfolio = $portfolio;
        $this->portfolioCategory = $portfolioCategory;
    }

    public function index()
    {
        return $this->portfolio->orderBy('id','desc')->get();
    }

    public function create()
    {
        return $this->portfolioCategory->get();
    }

    public function store($request)
    {
        DB::beginTransaction ();
        $slug = $request->en_name;
        $data = [
            'slug' => $slug,
            'portfolio_category_id' => $request->input ('category'),
            'mobileImage' => $this->uploadImage ($request->file ('mobileImage'),'images/portfolio'),
            'cover' => $this->uploadImage ($request->file ('cover'),'images/portfolio'),
            'link' => $request->input ('link'),
            'date' => $request->input ('date'),
            'name' => [
                'en' => $request->input('en_name'),
                'ar' => $request->input('ar_name')
            ],
            'client' => [
                'en' => $request->input('en_client'),
                'ar' => $request->input('ar_client')
            ],
            'desc' => [
                'en' => $request->input('en_desc'),
                'ar' => $request->input('ar_desc')
            ],
        ];
        $this->portfolio->create($data);
        DB::commit();
    }

    public function show()
    {
        //
    }

    public function edit($portfolio)
    {
        return $this->portfolio->findOrFail($portfolio);
    }

    public function update($request,$portfolio)
    {
        DB::beginTransaction();
        $portfolio = $this->portfolio->findOrFail($portfolio);
        $slug = $request->en_name;
        $data = [
            'slug' => $slug,
            'portfolio_category_id' => $request->input('category'),
            'mobileImage' => $this->UpdateUploadImage ($request->file('mobileImage'),'images/portfolio'),
            'cover' => $this->UpdateUploadImage ($request->file('cover'),'images/portfolio'),
            'link' => $request->input('link'),
            'date' => $request->input('date'),
            'name' => [
                'en' => $request->input('en_name'),
                'ar' => $request->input('ar_name')
            ],
            'client' => [
                'en' => $request->input('en_client'),
                'ar' => $request->input('ar_client')
            ],
            'desc' => [
                'en' => $request->input('en_desc'),
                'ar' => $request->input('ar_desc')
            ],
        ];
        $portfolio->update ($data);
        DB::commit ();
    }

    public function destroy ($portfolio)
    {
        $portfolio = $this->portfolio->findOrFail ($portfolio);
        $portfolio->delete ();
    }

    public function uploadImage ($image,$path)
    {
        $filename = $image->store($path, 'public');
        return $filename;
    }

    public function UpdateUploadImage ($image,$path)
    {
        //image
        if($image && file_exists(storage_path('app/public/' .$image))){
            Storage::delete('public/'. $image);
        }
        $new_image = $image->store($path, 'public');
        return $new_image;
    }
}
