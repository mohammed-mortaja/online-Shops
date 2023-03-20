<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
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
            'store_id' => Store::inRandomOrder()->first()->id,
        ];
    }
}
