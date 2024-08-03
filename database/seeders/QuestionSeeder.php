<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'evaluation_id' => 1,
            'question_text' => 'What does PHP stand for?',
            'question_type' => 'single_choice',
        ]);

        Question::create([
            'evaluation_id' => 1,
            'question_text' => 'Which of the following are PHP frameworks?',
            'question_type' => 'multiple_choice',
        ]);
    }
}
