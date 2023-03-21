<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class OwnerFactory extends Factory
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
            'name' =>$faker->name(2),
            'email' =>$faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'image' => 'default-image.png',
            'mobile' =>$faker->phoneNumber(),
            'address' =>$faker->address(),
            'city_id' => City::inRandomOrder()->first()->id,
        ];

}
}
