<?php

namespace Database\Seeders;

use App\Models\StudentEvaluation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentEvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentEvaluation::create([
            'user_id' => 3, // Assuming user ID 1 exists
            'evaluation_id' => 1, // Assuming evaluation ID 1 exists
            'completed_at' => now(),
        ]);

        StudentEvaluation::create([
            'user_id' => 4,
            'evaluation_id' => 1,
            'completed_at' => now(),
        ]);

        StudentEvaluation::create([
            'user_id' => 4,
            'evaluation_id' => 2,
            'completed_at' => now(),
        ]);
    }
}
