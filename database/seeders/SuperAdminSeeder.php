<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //------------- 02- Users  ------------//

        // Create Admin
        $yaser = new User();
        $yaser->first_name = 'Yaser';
        $yaser->last_name = 'System';
        $yaser->username = 'yaser';
        $yaser->email = 'yaser@gmail.com';
        $yaser->email_verified_at = now();
        $yaser->mobile = '00967772036111';
        $yaser->password = bcrypt('yaser321321');
        $yaser->user_image = 'avator.svg';
        $yaser->status = 1;
        $yaser->remember_token = Str::random(10);
        $yaser->save();




        //------------- 03- AttachRoles To  Users  ------------//


        $yaser->attachRole(Role::where('name', 'admin')->first()->id);
        $yaser->attachRole(Role::where('name', 'instructor')->first()->id);
    }
}
