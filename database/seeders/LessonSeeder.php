<?php

namespace Database\Seeders;

use App\Models\CourseSection;
use App\Models\Lesson;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        // Retrieve all course sections
        $sections = CourseSection::all();

        foreach ($sections as $section) {
            // Generate lessons based on lectures_count
            for ($i = 0; $i < $section->lectures_count; $i++) {
                Lesson::create([

                    'title' => ['ar' => $faker->sentence(3), 'en' => $faker->sentence(3)],

                    // 'url'      =>  $faker->url,

                    'url'      =>  "https://www.youtube.com/watch?v=bRgHWj3Am_M",
                    'duration_minutes' => $faker->time('H:i', 'now'),
                    'course_section_id' => $section->id,

                    'status' => true,
                    'published_on' => $faker->dateTime(),
                    'created_by' => $faker->name(),
                    'updated_by' => $faker->name(),
                ]);
            }
        }
    }
}
