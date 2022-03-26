<?php

namespace Database\Factories;

use App\Models\Portfolio\Portfolio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PortfolioFactory extends Factory
{
    protected $model = Portfolio::class;

    public function definition()
    {
        $name = $this->faker->title();

        for ($i = 0; $i <=3; $i++){
            $portfolio = DB::table ('portfolios')->insertGetId ([
                'pcategory_id' => Pcategory::inRandomOrder()->first()->id,
                'slug' => Str::slug ($name),
                'cover' => $this->faker->imageUrl (640,480),
                'mobileImage' => $this->faker->imageUrl (640,480),
                'link' => $this->faker->sentence(1),
                'date' => $this->faker->date ('Y-m-d',50)
            ]);
            DB::table('portfolio_translations')->insert([
                [
                    'name' => $name,
                    'client' => $this->faker->text(30),
                    'desc' => $this->faker->text(50),
                    'locale' => 'en',
                    'portfolio_id' => $portfolio
                ],
                [
                    'name' => $this->faker->text(10),
                    'client' => $this->faker->text(30),
                    'desc' => $this->faker->text(50),
                    'locale' => 'ar',
                    'portfolio_id' => $portfolio
                ]
            ]);
        }
//        $name = $this->faker->text(30);
//        return [
//            'name' => $name,
//            'client' => $this->faker->text(50),
//            'desc' => $this->faker->text(400),
//            'slug' => Str::slug ($name),
//            'pcategory_id' => 1,
//            'cover' => $this->faker->imageUrl($width = 400, $height = 400),
//            'mobileImage' => $this->faker->imageUrl($width = 400, $height = 400),
//            'link' => $this->faker->text(50),
//            'date' => $this->faker->date ('Y-m-d',50),
//        ];
    }
}
