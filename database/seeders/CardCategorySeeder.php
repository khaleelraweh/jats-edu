<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();


        $popgy['category_name'] = ['ar' => 'بوبجي', 'en' => 'PUBG', 'ca' => 'PUBG',];
        $popgy['description'] = ['ar' => 'معلومات اكثر عن البوبجي ', 'en' => 'More information about PUBG', 'ca' => 'Más información sobre PUBG',];
        $popgy['section'] = 2;
        $popgy['created_by'] = 'admin';
        $popgy['status'] = true;
        $popgy['published_on'] = $faker->dateTime();
        $popgy['parent_id'] = null;
        $popgy =  ProductCategory::create($popgy);



        $starWar['category_name'] = ['ar' => 'حرب النجوم', 'en' => 'star Wars', 'ca' => 'guerra de las Galaxias',];
        $starWar['description'] = ['ar' => 'معلومات اكثر عن حرب النجوز ', 'en' => 'More information about star Wars', 'ca' => 'guerra de las Galaxias',];
        $starWar['section'] = 2;
        $starWar['created_by'] = 'admin';
        $starWar['status'] = true;
        $starWar['published_on'] = $faker->dateTime();
        $starWar['parent_id'] = null;
        $starWar =  ProductCategory::create($starWar);

        $legend['category_name'] = ['ar' => 'الاسطورة', 'en' => 'the legend', 'ca' => 'La leyenda',];
        $legend['description'] = ['ar' => 'معلومات اكثر عن حرب الاسطورة ', 'en' => 'More information about the legend', 'ca' => 'guerra de las La leyenda',];
        $legend['section'] = 2;
        $legend['created_by'] = 'admin';
        $legend['status'] = true;
        $legend['published_on'] = $faker->dateTime();
        $legend['parent_id'] = null;
        $legend =  ProductCategory::create($legend);


        $middleCenteries['category_name'] = ['ar' => 'القرون الوسطي ', 'en' => 'Middle Centries', 'ca' => 'el cuerno medio',];
        $middleCenteries['description'] = ['ar' => 'معلومات اكثر عن حرب القرون الوسطي  ', 'en' => 'More information about the Middle Centries', 'ca' => 'el cuerno medio',];
        $middleCenteries['section'] = 2;
        $middleCenteries['created_by'] = 'admin';
        $middleCenteries['status'] = true;
        $middleCenteries['published_on'] = $faker->dateTime();
        $middleCenteries['parent_id'] = null;
        $middleCenteries =  ProductCategory::create($middleCenteries);
    }
}
