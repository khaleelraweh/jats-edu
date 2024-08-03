<?php

namespace Database\Seeders;

use App\Models\StudentAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming question ID 1 and 2, option IDs 1, 2, 3, and 4 exist

        // Student 1's answers
        StudentAnswer::create([
            'student_evaluation_id' => 1,
            'question_id' => 1,
            'option_id' => 1, // Correct answer
            // 'answer_text' => null,
        ]);

        StudentAnswer::create([
            'student_evaluation_id' => 1,
            'question_id' => 2,
            'option_id' => 3, // Incorrect answer
            // 'answer_text' => null,
        ]);

        // Student 2's answers
        StudentAnswer::create([
            'student_evaluation_id' => 2,
            'question_id' => 1,
            'option_id' => 2, // Incorrect answer
            // 'answer_text' => null,
        ]);

        StudentAnswer::create([
            'student_evaluation_id' => 2,
            'question_id' => 2,
            'option_id' => 1, // Correct answer
            // 'answer_text' => null,
        ]);
    }
}
