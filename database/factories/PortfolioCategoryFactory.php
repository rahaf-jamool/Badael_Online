<?php

namespace Database\Factories;

use App\Models\PortfolioCategory\Pcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PortfolioCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public $model = Pcategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->text(30)
        ];
    }
}
