<?php

namespace Database\Seeders;

use App\Models\Currency;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        // Currency::create(['currency_name'=>'ريال سعودي' , 'slug' =>$faker->unique()->slug(2,3), 'currency_symbol' =>'رس' , 'currency_code'=>'SAR' , 'exchange_rate' => 1 , 'status'=> true ]);
        // Currency::create(['currency_name'=>'ريال يمني' , 'slug' =>$faker->unique()->slug(2,3), 'currency_symbol' =>'ري' , 'currency_code'=>'YER' , 'exchange_rate' => 139 , 'status'=> true ]);
        // Currency::create(['currency_name'=>'دولار امريكي ' , 'slug' =>$faker->unique()->slug(2,3), 'currency_symbol' =>'USD' , 'currency_code'=>'$' , 'exchange_rate' => 0.2666 , 'status'=> true ]);


        Currency::create(['currency_name' => ['ar' => 'ريال سعودي', 'en' => 'Saudi Riyal'], 'slug' => json_encode(['ar' => 'ريال-سعودي', 'en' => 'Saudi-Riyal']), 'currency_symbol' => ['ar' => 'رس', 'en' => 'SR'], 'currency_code' => 'SAR', 'exchange_rate' => 1, 'status' => true]);
        Currency::create(['currency_name' => ['ar' => 'ريال يمني', 'en' => 'Yemeni Riyal'], 'slug' => json_encode(['ar' => 'ريال-يمني', 'en' => 'Yemeni-Riyal']), 'currency_symbol' => ['ar' => 'ري', 'en' => 'YR'], 'currency_code' => 'YER', 'exchange_rate' => 1, 'status' => true]);
        Currency::create(['currency_name' => ['ar' => 'دولار امريكي', 'en' => 'U.S Dollar'], 'slug' => json_encode(['ar' => 'دولار-امريكي', 'en' => 'U.S-Dollar']), 'currency_symbol' => ['ar' => '$', 'en' => '$'], 'currency_code' => 'USD', 'exchange_rate' => 1, 'status' => true]);
    }
}
