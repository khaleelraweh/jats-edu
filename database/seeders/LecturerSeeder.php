<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        //LecturerRole
        $lecturerRole = new Role();
        $lecturerRole->name         = 'lecturer';
        $lecturerRole->display_name = 'course lecturer';
        $lecturerRole->description  = 'lecturer is the person who  lecture courses';
        $lecturerRole->allowed_route = null;
        $lecturerRole->save();

        // Create lecturer
        $lecturer = User::create([
            'first_name' => 'lecturer',
            'last_name' => 'person',
            'username' => 'lecturer',
            'email' => 'lecturer@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '00967772036134',
            'password' => bcrypt('123123123'),
            'user_image' => 'avator.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);

        $lecturer->attachRole($lecturerRole);

        //------------- 04-2-  Create random lecturer and  AttachRole to lecturerRole  ------------//
        for ($i = 1; $i <= 20; $i++) {
            //Create random lecturer
            $random_lecturer = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->email,
                'email_verified_at' => now(),
                'mobile' => '0096777' . $faker->numberBetween(1000000, 9999999),
                'password' => bcrypt('123123123'),
                'user_image' => 'avator.svg',
                'status' => 1,
                'remember_token' => Str::random(10),
            ]);

            //Add lecturerRole to Randomlecturer
            $random_lecturer->attachRole($lecturerRole);
        }
    }
}
