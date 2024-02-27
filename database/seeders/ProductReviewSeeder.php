<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =Factory::create();

        Product::all()->each(function($product) use ($faker){
            
            $product->reviews()->create([  
                'user_id'   =>  rand(3,23),
                'name'      =>  $faker->userName(),
                'email'     =>  $faker->safeEmail(),
                'title'     =>  $faker->sentence(),
                'message'   =>  $faker->paragraph(),
                'status'    =>  rand(0,1),
                'rating'    =>  rand(1,5),
            ]);
            
        });
    }
}
