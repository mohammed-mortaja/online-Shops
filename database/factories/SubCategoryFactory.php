<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
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
            'name' =>$faker->name,    
            'image' => 'default-image.png',            
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
