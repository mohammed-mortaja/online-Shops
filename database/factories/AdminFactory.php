<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'image' => 'default-image.png',
            'mobile' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'city_id' => City::inRandomOrder()->first()->id,
        ];


    }
}
