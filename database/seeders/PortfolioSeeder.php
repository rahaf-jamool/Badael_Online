<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run ()
    {
        $faker = Faker::create ();
        $name = $faker->title ();
        for ($i = 0; $i <= 6; $i++) {
            $portfolio = DB::table ('portfolios')->insertGetId ([
                'pcategory_id' => $faker->numberBetween (1, 5),
                'slug' => Str::slug ($name),
                'cover' => $faker->imageUrl (640, 480),
                'mobileImage' => $faker->imageUrl (640, 480),
                'link' => $faker->sentence (1),
                'date' => $faker->date ('Y-m-d', 50)
            ]);
            DB::table ('portfolio_translations')->insert ([
                [
                    'name' => $faker->title (),
                    'client' => $faker->text (30),
                    'desc' => $faker->text (50),
                    'locale' => 'en',
                    'portfolio_id' => $portfolio
                ],
                [
                    'name' => $faker->text (10),
                    'client' => $faker->text (30),
                    'desc' => $faker->text (50),
                    'locale' => 'ar',
                    'portfolio_id' => $portfolio
                ]
            ]);
        }
    }
}
