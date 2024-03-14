<?php

namespace Database\Seeders;

use App\Models\Specialization;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get active users
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'lecturer');
        })->pluck('id');


        $Desiner = Specialization::create(['name' => ['ar' => 'مصمم', 'en'    =>  'Desiner']]);
        $Desiner->users()->sync($users->random(3));


        $Developer = Specialization::create(['name' => ['ar' => 'مبرمج', 'en'    =>  'Developer']]);
        $Developer->users()->sync($users->random(3));


        $softEngineer = Specialization::create(['name' => ['ar' => 'مهندس برمجيات', 'en'    =>  'SoftWare Engineer']]);
        $softEngineer->users()->sync($users->random(3));
    }
}
