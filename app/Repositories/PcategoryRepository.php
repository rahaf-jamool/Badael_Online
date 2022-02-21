<?php

namespace App\Repositories;

use App\Models\Pcategory\Pcategory;
use App\Models\Pcategory\PcategoryTranslation;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PcategoryRepository implements RepositoryInterface{

    private $pcategory;
    private $pcategoryTranslation;
    public function __construct(Pcategory $pcategory, PcategoryTranslation $pcategoryTranslation)
    {
        $this->pcategory = $pcategory;
        $this->pcategoryTranslation = $pcategoryTranslation;
    }

    public function index()
    {
        return $this->pcategory->orderBy('id','desc')->get();
    }

    public function create()
    {

    }

    public function store($request)
    {
        /** transformation to collection */
        $allpcategories = collect($request->pcategory)->all();

        $request->is_active ? $is_active = true : $is_active = false;

        DB::beginTransaction();
        // create the default language's banner
        $unTransPcategory_id = $this->pcategory->insertGetId([
            'is_active' => $request->is_active = 1
        ]);

        // check the Category and request
        if(isset($allpcategories) && count($allpcategories)){
            // insert other translation for Categories
            foreach ($allpcategories as $allpcategory){
                $transPcategory_arr[] = [
                    'name' => $allpcategory ['name'],
                    'local' => $allpcategory['local'],
                    'pcategory_id' => $unTransPcategory_id
                ];
            }

            $this->pcategoryTranslation->insert($transPcategory_arr);
        }
        DB::commit();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->pcategory::findOrFail($id);
    }

    public function update(Request $request,$id)
    {
        $pcategory = $this->pcategory::findOrFail($id);

            DB::beginTransaction();

            $unTransPcategory_id = $pcategory->where('pcategories.id',$pcategory->id)
                ->update([
                    'is_active' => $request->is_active = 1
                ]);

                $allpcategories = array_values($request->pcategory);
                // insert other translations for Pcategory
                foreach ($allpcategories as $allpcategory){
                    $this->pcategoryTranslation->where('pcategory_id',$id)
                    ->where('local',$allpcategory['local'])
                    ->update([
                        'name' => $allpcategory ['name'],
                        'pcategory_id' =>  $unTransPcategory_id
                    ]);
                }
                DB::commit();
    }

    public function destroy($id)
    {
        $pcategory = $this->pcategory::findOrFail($id);
        $pcategory->delete();
    }
}
