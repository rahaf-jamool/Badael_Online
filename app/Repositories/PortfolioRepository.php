<?php

namespace App\Repositories;

use App\Models\Portfolio\Portfolio;
use App\Models\PortfolioCategory\Pcategory;
use App\Repositories\Interfaces\PortfolioRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PortfolioRepository implements PortfolioRepositoryInterface {

    private $portfolio;
    private $pcategory;
    public function __construct(Portfolio $portfolio,Pcategory $pcategory)
    {
        $this->portfolio = $portfolio;
        $this->pcategory = $pcategory;

    }

    public function index()
    {
        return $this->portfolio->orderBy('id','desc')->get();
    }

    public function create()
    {
        return $this->pcategory->get();
    }

    public function store($request)
    {
        DB::beginTransaction ();
        $slug = $request->en_name;
        $data = [
            'slug' => $slug,
            'pcategory_id' => $request->input ('category'),
            'mobileImage' => $this->uploadImage ($request->file ('mobileImage'),'images/portfolio','public'),
            'cover' => $this->uploadImage ($request->file ('cover'),'images/portfolio','public'),
            'link' => $request->input ('link'),
            'date' => $request->input ('date'),
            'en' => [
                'name' => $request->input ('en_name'),
                'client' => $request->input ('en_client'),
                'desc' => $request->input ('en_desc'),
            ],
            'ar' => [
                'name' => $request->input ('ar_name'),
                'client' => $request->input ('ar_client'),
                'desc' => $request->input('ar_desc'),
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
            'pcategory_id' => $request->input('category'),
            'mobileImage' => $this->UpdateUploadImage ($request->file('mobileImage'),'images/portfolio','public'),
            'cover' => $this->UpdateUploadImage ($request->file('cover'),'images/portfolio','public'),
            'link' => $request->input('link'),
            'date' => $request->input('date'),
            'en' => [
                'name' => $request->input('en_name'),
                'client' => $request->input('en_client'),
                'desc' => $request->input('en_desc'),
            ],
            'ar' => [
                'name' => $request->input('ar_name'),
                'client' => $request->input('ar_client'),
                'desc' => $request->input('ar_desc'),
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

    public function uploadImage ($image,$path,$directory)
    {
        $filename = $image->store($path, $directory);
        return $filename;
    }

    public function UpdateUploadImage ($image,$path,$directory)
    {
        if($image && file_exists(storage_path('app/public/' .$image))){
            Storage::delete('public/'. $image);
        }
        $new_image = $image->store($path, $directory);
        return $new_image;
    }
}
