<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Options for the first question
        Option::create([
            'question_id' => 1,
            'option_text' => 'Personal Home Page',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => 1,
            'option_text' => 'Preprocessor Hypertext',
            'is_correct' => false,
        ]);

        // Options for the second question
        Option::create([
            'question_id' => 2,
            'option_text' => 'Laravel',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => 2,
            'option_text' => 'Symfony',
            'is_correct' => true,
        ]);

        Option::create([
            'question_id' => 2,
            'option_text' => 'Node.js',
            'is_correct' => false,
        ]);
    }
}
