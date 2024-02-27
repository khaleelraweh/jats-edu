<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Factory::create();
        $faker = Factory::create();


        //this will return all product categories id where it is submain categories 
        $categories = ProductCategory::whereNotNull('parent_id')->pluck('id');

        for ($i = 1; $i <= 50; $i++) {
            //انشاء مصفوفة لتخزين الف منتج فيها لاضافتها الي قاعدة البيانات

            $products[] = [
                'product_name'          =>  json_encode(
                    ['ar' => $faker->unique()->realTextBetween(10, 12), 'en' => $faker->unique()->realTextBetween(10, 12), 'ca' => $faker->unique()->realTextBetween()]
                ),
                'slug'          =>  json_encode(
                    ['ar' => $faker->unique()->slug(2, 3), 'en' => $faker->unique()->slug(2, 3), 'ca' => $faker->unique()->slug(2, 3)]
                ),
                'description'   =>  json_encode(
                    ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)]
                ),
                'quantity'      =>  $faker->numberBetween(10, 100),
                'price'         =>  $faker->numberBetween(5, 200),
                'offer_price'   => $faker->numberBetween(5, 100),
                'offer_ends'    =>  $faker->dateTime(),
                'sku'           =>  $faker->realText(10),
                'max_order'     =>  $faker->numberBetween(5, 10),
                'featured'      =>  rand(0, 1),
                'status'        => true,
                'product_category_id'   =>  $categories->random(),
                'published_on'          => $faker->dateTime(),
                'created_by'            =>  $faker->realTextBetween(10, 20),
                'created_at'            => now(),
                'updated_at'            => now(),

            ];
        }

        // ادخال البيانات علي شكل دفع مكونة من مئة سجل لكي لا يتم اجهاد المعالج
        $chuncks = array_chunk($products, 100);
        foreach ($chuncks as $chunck) {
            Product::insert($chunck);
        }
    }
}
