<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WebMenu;
use Faker\Factory;

class PolicyPrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        WebMenu::create(['title'  => ['ar' => 'الرئيسية', 'en' => 'Main'], 'icon'   => 'fa fa-home', 'created_by' => 'admin', 'status' => true, 'section'    =>  6, 'published_on' => $faker->dateTime(), 'parent_id' => null]);
        WebMenu::create(['title'  => ['ar' => 'خريطة الموقع', 'en' => 'Site map'], 'icon'   => 'fa fa-home', 'created_by' => 'admin', 'status' => true, 'section'    =>  6, 'published_on' => $faker->dateTime(), 'parent_id' => null]);
        WebMenu::create(['title'  => ['ar' => 'سياسات الخصوصية', 'en' => 'Privacy policies'], 'icon'   => 'fa fa-home', 'created_by' => 'admin', 'status' => true, 'section'    =>  6, 'published_on' => $faker->dateTime(), 'parent_id' => null]);
        WebMenu::create(['title'  => ['ar' => 'سياسات استخدام الويب', 'en' => 'Web usage policies'], 'icon'   => 'fa fa-home', 'created_by' => 'admin', 'status' => true, 'section'    =>  6, 'published_on' => $faker->dateTime(), 'parent_id' => null]);
    }
}
