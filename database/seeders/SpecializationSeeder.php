<?php

namespace Database\Seeders;

use App\Models\Specialization;
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
        Specialization::create(['name' => ['ar' => 'مصمم', 'en'    =>  'Desiner']]);
        Specialization::create(['name' => ['ar' => 'مبرمج', 'en'    =>  'Developer']]);
        Specialization::create(['name' => ['ar' => 'مهندس برمجيات', 'en'    =>  'SoftWare Engineer']]);
    }
}
