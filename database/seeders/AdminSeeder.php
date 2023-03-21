<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin::factory(3)->create();
        Admin::create([
            'name' => 'محمد مررتجى',
            'email' => 'm@mortaja.ps',
            'password' => Hash::make('password'),
            'mobile' => '970597433254',
            'image' => 'default-image.png',
            'city_id' => City::inRandomOrder()->first()->id,

        ]);
    }
}
