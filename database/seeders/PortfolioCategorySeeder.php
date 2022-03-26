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
            DB::table ('portfolio_categories')->insert ([
                'name' => $faker->title (),
            ]);
        }
    }
}
