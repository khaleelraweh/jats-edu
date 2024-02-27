<?php

namespace Database\Seeders;

use App\Models\CardCode;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $cards = Product::where('status', true)->pluck('id');

        for ($i = 1; $i <= 30; $i++) {
            //انشاء مصفوفة لتخزين الف منتج فيها لاضافتها الي قاعدة البيانات

            $card_codes[] = [
                'code'                  => $faker->numberBetween(10000000, 99999999),
                'order_id'              => rand(0, 1),
                'code_type'             => rand(0, 1), // صفر مباشر و الواحد غير مباشر
                'encoding_type'         => 0,
                'product_id'            =>  $cards->random(),

                'status'                => rand(true, false),
                'published_on'          => $faker->dateTime(),
                'created_by'            =>  $faker->realTextBetween(10, 20),
                'created_at'            => now(),
                'updated_at'            => now(),

            ];
        }


        // ادخال البيانات علي شكل دفع مكونة من مئة سجل لكي لا يتم اجهاد المعالج
        $chuncks = array_chunk($card_codes, 100);
        foreach ($chuncks as $chunck) {
            CardCode::insert($chunck);
        }
    }
}
