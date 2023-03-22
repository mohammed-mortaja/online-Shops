<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ar_SA');
        return [
            'product_name' =>$faker->domainName(),    
            'product_prise' =>$faker->numberBetween( 0,  100),
            'image' => 'default-image.png',            
            'sub_category_id' => SubCategory::inRandomOrder()->first()->id,
        ];
    }
}
