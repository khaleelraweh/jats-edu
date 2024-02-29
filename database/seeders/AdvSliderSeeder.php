<?php

namespace Database\Seeders;

use App\Models\Slider;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AdvSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $target = ['_self', '_blank'];


        Slider::create(['title'  => ['ar' => 'الدورات عبر الإنترنت 100,000', 'en' => 'Main'], 'description' => ['ar' => 'استكشاف مجموعة متنوعة من المواضيع الجديدة', 'en' => ''], 'url'  =>  'https://' . $faker->slug(2) . '.com', 'target' =>  Arr::random($target),   'icon'   => 'fas fa-code', 'section' => 2, 'created_by' => 'admin', 'status' => true, 'published_on' => $faker->dateTime()]);
        Slider::create(['title'  => ['ar' => 'تعليمات الخبراء', 'en' => 'Main'], 'description' => ['ar' => 'ابحث عن المدرب المناسب لك', 'en' => ''], 'url'  =>  'https://' . $faker->slug(2) . '.com', 'target' =>  Arr::random($target),   'icon'   => 'fas fa-laptop-code', 'section' => 2, 'created_by' => 'admin', 'status' => true, 'published_on' => $faker->dateTime()]);
        Slider::create(['title'  => ['ar' => 'الوصول مدى الحياة', 'en' => 'Main'], 'description' => ['ar' => 'تعلم في الجدول الزمني الخاص بك', 'en' => ''], 'url'  =>  'https://' . $faker->slug(2) . '.com', 'target' =>  Arr::random($target),   'icon'   => 'fas fa-chalkboard-teacher', 'section' => 2, 'created_by' => 'admin', 'status' => true, 'published_on' => $faker->dateTime()]);
    }
}
