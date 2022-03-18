<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 30; $i++){
          Product::create([
            'image'=>$faker->imageUrl($width = 200, $height = 200),
            'name'=>$faker->word(),
            'description'=>$faker->paragraph(),
            'price'=>$faker->numberBetween($min=20, $max=200),
            'quantity'=>$faker->randomDigitNotNull(),
          ]);
        }
    }
}
