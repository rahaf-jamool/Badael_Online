<?php

namespace App\Repositories;

use App\Models\Pcategory\Pcategory;
use App\Models\Portfolio\Portfolio;
use App\Repositories\Interfaces\RepositoryInterface;
use App\Models\Portfolio\PortfolioTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PortfolioRepository implements RepositoryInterface{

    private $pcategory;
    private $portfolio;
    private $portfolioTranslation;
    public function __construct(Portfolio $portfolio, PortfolioTranslation $portfolioTranslation, Pcategory $pcategory)
    {
        $this->pcategory = $pcategory;
        $this->portfolio = $portfolio;
        $this->portfolioTranslation = $portfolioTranslation;
    }

    public function index()
    {
        return $this->portfolio->orderBy('id','desc')->get();
    }

    public function create()
    {
        return $this->pcategory->get();
    }

    public function store(Request $request)
    {

        DB::beginTransaction();

        $cover = $request->file('cover');
        if($cover){
            $cover_path = $cover->store('images/portfolio', 'public');
        }

        $mobileImage = $request->file('mobileImage');
        if($mobileImage){
            $mobileImage_path = $mobileImage->store('images/portfolio', 'public');
        }

        $slug = $request->en_name;

        $data = [
            'slug' => $slug,
            'pcategory_id' => $request->input('category'),
            'mobileImage' => $mobileImage_path,
            'cover' => $cover_path,
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

        $this->portfolio::create($data);

        DB::commit();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $portfolio = $this->portfolio->findOrFail($id);
        $categories = $this->pcategory->get();

        return view('admin.portfolio.edit',compact('portfolio','categories'));
    }

    public function update(Request $request,$id)
    {
        DB::beginTransaction();

        $portfolio = $this->portfolio->findOrFail($id);
        // image desktop
        $new_cover = $request->file('cover');

        if($new_cover){
            if($portfolio->cover && file_exists(storage_path('app/public/' .$portfolio->cover))){
                Storage::delete('public/'. $portfolio->cover);
            }
            $new_cover_path = $new_cover->store('images/portfolio', 'public');

        }
        // image mobile
        $new_mobileImage = $request->file('mobileImage');

        if($new_mobileImage){
            if($portfolio->mobileImage && file_exists(storage_path('app/public/' . $portfolio->mobileImage))){
                Storage::delete('public/'. $portfolio->mobileImage);
            }
            $new_mobileImage_path = $new_mobileImage->store('images/portfolio', 'public');

        }

        $slug = $request->en_name;

        $data = [
            'slug' => $slug,
            'pcategory_id' => $request->input('category'),
            'mobileImage' => $new_mobileImage_path,
            'cover' => $new_cover_path,
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
        $portfolio->update($data);

        DB::commit();
    }

    public function destroy($id)
    {
        $portfolio = $this->portfolio->findOrFail($id);
        $portfolio->delete();
    }
}
