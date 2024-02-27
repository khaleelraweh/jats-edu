<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();


        $Personal_development['category_name'] = ['ar' => 'تطوير الذات', 'en' => 'Personal Development'];
        $Personal_development['description'] = ['ar' => 'اكثر من 100 دورة ', 'en' => 'Over 100 Courses', 'ca' => 'el cuerno clothes',];
        $Personal_development['icon'] = 'far fa-file-alt';
        $Personal_development['created_by'] = 'admin';
        $Personal_development['status'] = true;
        $Personal_development['published_on'] = $faker->dateTime();
        $Personal_development['parent_id'] = null;
        $Personal_development =  CourseCategory::create($Personal_development);


        $Software_development['category_name'] = ['ar' => 'تطوير البرمجيات', 'en' => 'Software Development'];
        $Software_development['description'] = ['ar' => 'اكثر من 250 دورة ', 'en' => 'Over 250 Courses', 'ca' => 'el cuerno clothes',];
        $Software_development['icon'] = 'fas fa-laptop-code';
        $Software_development['created_by'] = 'admin';
        $Software_development['status'] = true;
        $Software_development['published_on'] = $faker->dateTime();
        $Software_development['parent_id'] = null;
        $Software_development =  CourseCategory::create($Software_development);


        $Business['category_name'] = ['ar' => 'إدارة اعمال', 'en' => 'Business'];
        $Business['description'] = ['ar' => 'اكثر من 500 دورة ', 'en' => 'Over 500 Courses', 'ca' => 'el cuerno clothes',];
        $Business['icon'] = 'fas fa-briefcase';
        $Business['created_by'] = 'admin';
        $Business['status'] = true;
        $Business['published_on'] = $faker->dateTime();
        $Business['parent_id'] = null;
        $Business =  CourseCategory::create($Business);

        $Design['category_name'] = ['ar' => 'تصميم', 'en' => 'Design'];
        $Design['description'] = ['ar' => 'اكثر من 960 دورة ', 'en' => 'Over 960 Courses', 'ca' => 'el cuerno clothes',];
        $Design['icon'] = 'fas fa-bezier-curve';
        $Design['created_by'] = 'admin';
        $Design['status'] = true;
        $Design['published_on'] = $faker->dateTime();
        $Design['parent_id'] = null;
        $Design =  CourseCategory::create($Design);

        $Finance_and_accounting['category_name'] = ['ar' => 'المالية والمحاسبة', 'en' => 'Finance and Accounting'];
        $Finance_and_accounting['description'] = ['ar' => 'اكثر من 320 دورة ', 'en' => 'Over 320 Courses', 'ca' => 'el cuerno clothes',];
        $Finance_and_accounting['icon'] = 'fas fa-wallet';
        $Finance_and_accounting['created_by'] = 'admin';
        $Finance_and_accounting['status'] = true;
        $Finance_and_accounting['published_on'] = $faker->dateTime();
        $Finance_and_accounting['parent_id'] = null;
        $Finance_and_accounting =  CourseCategory::create($Finance_and_accounting);

        $Marketing['category_name'] = ['ar' => 'تسويق', 'en' => 'Marketing'];
        $Marketing['description'] = ['ar' => 'اكثر من 960 دورة ', 'en' => 'Over 960 Courses', 'ca' => 'el cuerno clothes',];
        $Marketing['icon'] = 'fas fa-bullhorn';
        $Marketing['created_by'] = 'admin';
        $Marketing['status'] = true;
        $Marketing['published_on'] = $faker->dateTime();
        $Marketing['parent_id'] = null;
        $Marketing =  CourseCategory::create($Marketing);

        $audio_and_music['category_name'] = ['ar' => 'الصوت والموسيقى', 'en' => 'Audio and Music'];
        $audio_and_music['description'] = ['ar' => 'اكثر من 200 دورة ', 'en' => 'Over 200 Courses', 'ca' => 'el cuerno clothes',];
        $audio_and_music['icon'] = 'fas fa-music';
        $audio_and_music['created_by'] = 'admin';
        $audio_and_music['status'] = true;
        $audio_and_music['published_on'] = $faker->dateTime();
        $audio_and_music['parent_id'] = null;
        $audio_and_music =  CourseCategory::create($audio_and_music);


        $photography['category_name'] = ['ar' => 'التصوير', 'en' => 'photography'];
        $photography['description'] = ['ar' => 'اكثر من 120 دورة ', 'en' => 'Over 120 Courses', 'ca' => 'el cuerno clothes',];
        $photography['icon'] = 'fas fa-camera';
        $photography['created_by'] = 'admin';
        $photography['status'] = true;
        $photography['published_on'] = $faker->dateTime();
        $photography['parent_id'] = null;
        $photography =  CourseCategory::create($photography);
    }
}
