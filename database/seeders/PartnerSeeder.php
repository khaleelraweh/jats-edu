<?php

namespace Database\Seeders;

use App\Models\Partner;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $patner1 = Partner::create([
            'title' => ['ar'    => 'هائل سعيد انعم وشركاه', 'en'    =>  'Hayel Saeed Anam and Partners'],
            'description' => ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)],
            'partner_image' => 'hayel.jpg',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'created_by' => $faker->realTextBetween(10, 20),
            'updated_by' => $faker->realTextBetween(10, 20), // Assuming you want this as well
        ]);

        $patner2 = Partner::create([
            'title' => ['ar'    =>   'وزارة التربية والتعليم', 'en'    =>  'The Ministry of Education'],
            'description' => ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)],
            'partner_image' => 'education.jpg',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'created_by' => $faker->realTextBetween(10, 20),
            'updated_by' => $faker->realTextBetween(10, 20), // Assuming you want this as well
        ]);

        $patner3 = Partner::create([
            'title' => ['ar'    =>   'وزارة التربية والتعليم', 'en'    =>  'The Ministry of Education'],
            'description' => ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)],
            'partner_image' => 'education.jpg',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'created_by' => $faker->realTextBetween(10, 20),
            'updated_by' => $faker->realTextBetween(10, 20), // Assuming you want this as well
        ]);

        $patner3 = Partner::create([
            'title' => ['ar'    =>   'وزارة التعليم الفني والتدريب المهني ', 'en'    =>  'Ministry of Technical Education and Vocational Training'],
            'description' => ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)],
            'partner_image' => 'فechnical.jpg',
            'status' => true,
            'published_on' => $faker->dateTime(),
            'created_by' => $faker->realTextBetween(10, 20),
            'updated_by' => $faker->realTextBetween(10, 20), // Assuming you want this as well
        ]);
    }
}
