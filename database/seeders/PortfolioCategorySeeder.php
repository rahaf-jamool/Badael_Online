<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory\Pcategory;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioCategorySeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i <=6; $i++) {
            $pcategory = DB::table ('pcategories')->insertGetId ([

            ]);
            DB::table ('pcategory_translations')->insert ([
                [
                    'name' => $faker->title (),
                    'locale' => 'en',
                    'pcategory_id' => $pcategory
                ],
                [
                    'name' => $faker->title (),
                    'locale' => 'ar',
                    'pcategory_id' => $pcategory
                ]
            ]);
        }
    }
}
