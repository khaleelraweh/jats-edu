<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Instructor::create(
            [
                'name'              => ['ar' => 'كريستون بيل', 'en' => 'Kriston pal'],
                'email'             =>  'kriston@gmail.com',
                'phone'             =>  $faker->phoneNumber(),
                'specialization'    => ['ar' => 'مصمم تجربة المستخدم', 'en' => 'User Experience Designer'],
                'status'            =>  true,

                'facebook'          =>  'www.facebook.com',
                'twitter'           =>  'www.twitter.com',
                'instagram'         =>  'www.instagram.com',
                'linkedin'          =>  'www.linkedin.com',
            ]
        );



        Instructor::create(
            [
                'name'              => ['ar' => 'انا ريتشرد', 'en' => 'Ann Richard'],
                'email'             =>  'ann2@gmail.com',
                'phone'             =>  $faker->phoneNumber(),
                'specialization'    => ['ar' => 'مدون السفر', 'en' => 'Travel Bloger'],
                'status'            =>  true,
                'facebook'          =>  'www.facebook.com',
                'twitter'           =>  'www.twitter.com',
                'instagram'         =>  'www.instagram.com',
                'linkedin'          =>  'www.linkedin.com',
            ]
        );

        Instructor::create(
            [
                'name'              => ['ar' => 'جاك ويلسون', 'en' => 'Jack Wilson'],
                'email'             =>  'Jack@gmail.com',
                'phone'             =>  $faker->phoneNumber(),
                'specialization'    => ['ar' => 'مطور', 'en' => 'Developer'],
                'status'            =>  true,
                'facebook'          =>  'www.facebook.com',
                'twitter'           =>  'www.twitter.com',
                'instagram'         =>  'www.instagram.com',
                'linkedin'          =>  'www.linkedin.com',
            ]
        );

        Instructor::create(
            [
                'name'              => ['ar' => 'كاثيلين مونيرو', 'en' => 'Kathlen Monero'],
                'email'             =>  'Kathlen@gmail.com',
                'phone'             =>  $faker->phoneNumber(),
                'specialization'    => ['ar' => 'مصمم', 'en' => 'Designer'],
                'status'            =>  true,
                'facebook'          =>  'www.facebook.com',
                'twitter'           =>  'www.twitter.com',
                'instagram'         =>  'www.instagram.com',
                'linkedin'          =>  'www.linkedin.com',
            ]
        );
        Instructor::create(
            [
                'name'              => ['ar' => 'محمد علي', 'en' => 'Mohamed ali'],
                'email'             =>  'Mohamed@gmail.com',
                'phone'             =>  $faker->phoneNumber(),
                'specialization'    => ['ar' => 'مصمم', 'en' => 'Designer'],
                'status'            =>  true,
                'facebook'          =>  'www.facebook.com',
                'twitter'           =>  'www.twitter.com',
                'instagram'         =>  'www.instagram.com',
                'linkedin'          =>  'www.linkedin.com',
            ]
        );
        Instructor::create(
            [
                'name'              => ['ar' => 'طلال علي', 'en' => 'talal ali'],
                'email'             =>  'talal@gmail.com',
                'phone'             =>  $faker->phoneNumber(),
                'specialization'    => ['ar' => 'مصمم', 'en' => 'Designer'],
                'status'            =>  true,
                'facebook'          =>  'www.facebook.com',
                'twitter'           =>  'www.twitter.com',
                'instagram'         =>  'www.instagram.com',
                'linkedin'          =>  'www.linkedin.com',
            ]
        );
    }
}
