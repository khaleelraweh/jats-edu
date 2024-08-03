<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evaluation::create([
            'course_section_id' => 1, // Assuming there's a course section with ID 1
            'title' => 'Basic PHP Evaluation',
            'description' => 'An evaluation to test basic PHP knowledge.',
        ]);

        Evaluation::create([
            'course_section_id' => 2,
            'title' => 'Advanced Laravel Evaluation',
            'description' => 'An evaluation to test advanced Laravel skills.',
        ]);
    }
}
