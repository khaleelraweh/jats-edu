<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Instructor;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $instrustors = Instructor::active()->inRandomOrder()->take(3)->get();



        $categories = CourseCategory::query()->Active()->pluck('id');


        $courses1['title']            =   ['ar' => 'تصوير الأزياء من المحترفين', 'en' => 'Fashion Photography From Professional'];
        $courses1['subtitle']            =   ['ar' => 'عنوان فرعي', 'en' => 'subtitle'];

        $courses1['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses1['skill_level']            =  1;
        $courses1['language']             =  1;
        $courses1['Lecture_numbers']          =  5;
        $courses1['course_duration']            =  "8h  12m";

        // by alyamany
        $courses1['video_promo']             =  "https://www.youtube.com/watch?v=9vn_e_XPV4s&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO";
        $courses1['video_description']            =  "https://www.youtube.com/watch?v=N2EfGEPI_q8&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO&index=4";
        $courses1['course_type']            =  1;


        $courses1['price']                  =   $faker->numberBetween(5, 200);
        $courses1['offer_price']            =   $faker->numberBetween(5, 100);
        $courses1['offer_ends']             =   $faker->dateTime();

        $courses1['featured']               =   rand(0, 1);
        $courses1['status']                 =   true;
        $courses1['course_category_id']     =   8;
        $courses1['published_on']           =   $faker->dateTime();
        $courses1['created_by']             =   $faker->realTextBetween(10, 20);
        $courses1['created_at']             =   now();
        $courses1['updated_at']             =   now();
        $courses1                           =   Course::create($courses1);

        $courses1->instructors()->attach($instrustors->pluck('id')->toArray());


        $courses2['title']            =   ['ar' => 'دورة جافا سكريبت الكاملة 2020: بناء مشاريع حقيقية!', 'en' => 'The Complete JavaScript Course 2020: Build Real Projects!'];
        $courses2['subtitle']            =   ['ar' => 'عنوان فرعي', 'en' => 'subtitle'];

        $courses2['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses2['skill_level']            =  1;
        $courses2['language']             =  1;
        $courses2['Lecture_numbers']          =  5;
        $courses2['course_duration']            =  "8h  12m";

        // by alyamany
        $courses2['video_promo']             =  "https://www.youtube.com/watch?v=9vn_e_XPV4s&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO";
        $courses2['video_description']            =  "https://www.youtube.com/watch?v=N2EfGEPI_q8&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO&index=4";
        $courses2['course_type']            =  1;

        $courses2['price']                  =   $faker->numberBetween(5, 200);
        $courses2['offer_price']            =   $faker->numberBetween(5, 100);
        $courses2['offer_ends']             =   $faker->dateTime();

        $courses2['featured']               =   rand(0, 1);
        $courses2['status']                 =   true;
        $courses2['course_category_id']     =   2;
        $courses2['published_on']           =   $faker->dateTime();
        $courses2['created_by']             =   $faker->realTextBetween(10, 20);
        $courses2['created_at']             =   now();
        $courses2['updated_at']             =   now();
        $courses2                           =   Course::create($courses2);

        $courses3['title']            =   ['ar' => 'دورة جافا سكريبت الكاملة 2020: بناء مشاريع حقيقية!', 'en' => 'The Complete JavaScript Course 2020: Build Real Projects!'];
        $courses3['subtitle']            =   ['ar' => 'عنوان فرعي', 'en' => 'subtitle'];

        $courses3['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses3['skill_level']            =  1;
        $courses3['language']             =  1;
        $courses3['Lecture_numbers']          =  5;
        $courses3['course_duration']            =  "8h  12m";

        // by alyamany
        $courses3['video_promo']             =  "https://www.youtube.com/watch?v=9vn_e_XPV4s&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO";
        $courses3['video_description']            =  "https://www.youtube.com/watch?v=N2EfGEPI_q8&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO&index=4";
        $courses3['course_type']            =  1;

        $courses3['price']                  =   $faker->numberBetween(5, 200);
        $courses3['offer_price']            =   $faker->numberBetween(5, 100);
        $courses3['offer_ends']             =   $faker->dateTime();

        $courses3['featured']               =   rand(0, 1);
        $courses3['status']                 =   true;
        $courses3['course_category_id']     =   4;
        $courses3['published_on']           =   $faker->dateTime();
        $courses3['created_by']             =   $faker->realTextBetween(10, 20);
        $courses3['created_at']             =   now();
        $courses3['updated_at']             =   now();
        $courses3                           =   Course::create($courses3);

        $courses4['title']            =   ['ar' => 'تعلم الشكل: أساسيات تصميم واجهة المستخدم - تصميم UI/UX', 'en' => 'Learn Figma: User Interface Design Essentials - UI/UX Design'];
        $courses4['subtitle']            =   ['ar' => 'عنوان فرعي', 'en' => 'subtitle'];
        $courses4['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses4['skill_level']            =  1;
        $courses4['language']             =  1;
        $courses4['Lecture_numbers']          =  5;
        $courses4['course_duration']            =  "8h  12m";

        // by alyamany
        $courses4['video_promo']             =  "https://www.youtube.com/watch?v=9vn_e_XPV4s&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO";
        $courses4['video_description']            =  "https://www.youtube.com/watch?v=N2EfGEPI_q8&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO&index=4";
        $courses4['course_type']            =  1;

        $courses4['price']                  =   $faker->numberBetween(5, 200);
        $courses4['offer_price']            =   $faker->numberBetween(5, 100);
        $courses4['offer_ends']             =   $faker->dateTime();

        $courses4['featured']               =   rand(0, 1);
        $courses4['status']                 =   true;
        $courses4['course_category_id']     =   4;
        $courses4['published_on']           =   $faker->dateTime();
        $courses4['created_by']             =   $faker->realTextBetween(10, 20);
        $courses4['created_at']             =   now();
        $courses4['updated_at']             =   now();
        $courses4                           =   Course::create($courses4);


        $courses5['title']            =   ['ar' => 'دورة المحلل المالي الكاملة 2020', 'en' => 'The Complete Financial Analyst Course 2020'];
        $courses5['subtitle']            =   ['ar' => 'عنوان فرعي', 'en' => 'subtitle'];
        $courses5['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses5['skill_level']            =  1;
        $courses5['language']             =  1;
        $courses5['Lecture_numbers']          =  5;
        $courses5['course_duration']            =  "8h  12m";

        // by alyamany
        $courses5['video_promo']             =  "https://www.youtube.com/watch?v=9vn_e_XPV4s&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO";
        $courses5['video_description']            =  "https://www.youtube.com/watch?v=N2EfGEPI_q8&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO&index=4";
        $courses5['course_type']            =  1;

        $courses5['price']                  =   $faker->numberBetween(5, 200);
        $courses5['offer_price']            =   $faker->numberBetween(5, 100);
        $courses5['offer_ends']             =   $faker->dateTime();

        $courses5['featured']               =   rand(0, 1);
        $courses5['status']                 =   true;
        $courses5['course_category_id']     =   $categories->random();
        $courses5['published_on']           =   $faker->dateTime();
        $courses5['created_by']             =   $faker->realTextBetween(10, 20);
        $courses5['created_at']             =   now();
        $courses5['updated_at']             =   now();
        $courses5                           =   Course::create($courses5);


        $courses6['title']            =   ['ar' => 'تصوير الأزياء من المحترفين', 'en' => 'Fashion Photography From Professional'];
        $courses6['subtitle']            =   ['ar' => 'عنوان فرعي', 'en' => 'subtitle'];
        $courses6['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses6['skill_level']            =  1;
        $courses6['language']             =  1;
        $courses6['Lecture_numbers']          =  5;
        $courses6['course_duration']            =  "8h  12m";

        // by alyamany
        $courses6['video_promo']             =  "https://www.youtube.com/watch?v=9vn_e_XPV4s&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO";
        $courses6['video_description']            =  "https://www.youtube.com/watch?v=N2EfGEPI_q8&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO&index=4";
        $courses6['course_type']            =  1;

        $courses6['price']                  =   $faker->numberBetween(5, 200);
        $courses6['offer_price']            =   $faker->numberBetween(5, 100);
        $courses6['offer_ends']             =   $faker->dateTime();

        $courses6['featured']               =   rand(0, 1);
        $courses6['status']                 =   true;
        $courses6['course_category_id']     =   $categories->random();
        $courses6['published_on']           =   $faker->dateTime();
        $courses6['created_by']             =   $faker->realTextBetween(10, 20);
        $courses6['created_at']             =   now();
        $courses6['updated_at']             =   now();
        $courses6                           =   Course::create($courses6);
    }
}
