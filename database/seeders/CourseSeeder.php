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


        $courses1['course_name']            =   ['ar' => 'تصوير الأزياء من المحترفين', 'en' => 'Fashion Photography From Professional'];
        $courses1['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses1['course_level']            =  1;
        $courses1['course_lang']             =  1;
        $courses1['course_lessons_number']          =  5;
        $courses1['course_lessons_time']            =  "8h  12m";


        $courses1['quantity']               =   $faker->numberBetween(10, 100);
        $courses1['price']                  =   $faker->numberBetween(5, 200);
        $courses1['offer_price']            =   $faker->numberBetween(5, 100);
        $courses1['offer_ends']             =   $faker->dateTime();
        $courses1['sku']                    =   $faker->realText(10);
        $courses1['max_order']              =   $faker->numberBetween(5, 10);
        $courses1['featured']               =   rand(0, 1);
        $courses1['status']                 =   true;
        $courses1['course_category_id']     =   8;
        $courses1['published_on']           =   $faker->dateTime();
        $courses1['created_by']             =   $faker->realTextBetween(10, 20);
        $courses1['created_at']             =   now();
        $courses1['updated_at']             =   now();
        $courses1                           =   Course::create($courses1);

        $courses1->instructors()->attach($instrustors->pluck('id')->toArray());


        $courses2['course_name']            =   ['ar' => 'دورة جافا سكريبت الكاملة 2020: بناء مشاريع حقيقية!', 'en' => 'The Complete JavaScript Course 2020: Build Real Projects!'];
        $courses2['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses2['course_level']            =  1;
        $courses2['course_lang']             =  1;
        $courses2['course_lessons_number']          =  5;
        $courses2['course_lessons_time']            =  "8h  12m";

        $courses2['quantity']               =   $faker->numberBetween(10, 100);
        $courses2['price']                  =   $faker->numberBetween(5, 200);
        $courses2['offer_price']            =   $faker->numberBetween(5, 100);
        $courses2['offer_ends']             =   $faker->dateTime();
        $courses2['sku']                    =   $faker->realText(10);
        $courses2['max_order']              =   $faker->numberBetween(5, 10);
        $courses2['featured']               =   rand(0, 1);
        $courses2['status']                 =   true;
        $courses2['course_category_id']     =   2;
        $courses2['published_on']           =   $faker->dateTime();
        $courses2['created_by']             =   $faker->realTextBetween(10, 20);
        $courses2['created_at']             =   now();
        $courses2['updated_at']             =   now();
        $courses2                           =   Course::create($courses2);

        $courses3['course_name']            =   ['ar' => 'دورة جافا سكريبت الكاملة 2020: بناء مشاريع حقيقية!', 'en' => 'The Complete JavaScript Course 2020: Build Real Projects!'];
        $courses3['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses3['course_level']            =  1;
        $courses3['course_lang']             =  1;
        $courses3['course_lessons_number']          =  5;
        $courses3['course_lessons_time']            =  "8h  12m";

        $courses3['quantity']               =   $faker->numberBetween(10, 100);
        $courses3['price']                  =   $faker->numberBetween(5, 200);
        $courses3['offer_price']            =   $faker->numberBetween(5, 100);
        $courses3['offer_ends']             =   $faker->dateTime();
        $courses3['sku']                    =   $faker->realText(10);
        $courses3['max_order']              =   $faker->numberBetween(5, 10);
        $courses3['featured']               =   rand(0, 1);
        $courses3['status']                 =   true;
        $courses3['course_category_id']     =   4;
        $courses3['published_on']           =   $faker->dateTime();
        $courses3['created_by']             =   $faker->realTextBetween(10, 20);
        $courses3['created_at']             =   now();
        $courses3['updated_at']             =   now();
        $courses3                           =   Course::create($courses3);

        $courses4['course_name']            =   ['ar' => 'تعلم الشكل: أساسيات تصميم واجهة المستخدم - تصميم UI/UX', 'en' => 'Learn Figma: User Interface Design Essentials - UI/UX Design'];
        $courses4['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses4['course_level']            =  1;
        $courses4['course_lang']             =  1;
        $courses4['course_lessons_number']          =  5;
        $courses4['course_lessons_time']            =  "8h  12m";

        $courses4['quantity']               =   $faker->numberBetween(10, 100);
        $courses4['price']                  =   $faker->numberBetween(5, 200);
        $courses4['offer_price']            =   $faker->numberBetween(5, 100);
        $courses4['offer_ends']             =   $faker->dateTime();
        $courses4['sku']                    =   $faker->realText(10);
        $courses4['max_order']              =   $faker->numberBetween(5, 10);
        $courses4['featured']               =   rand(0, 1);
        $courses4['status']                 =   true;
        $courses4['course_category_id']     =   4;
        $courses4['published_on']           =   $faker->dateTime();
        $courses4['created_by']             =   $faker->realTextBetween(10, 20);
        $courses4['created_at']             =   now();
        $courses4['updated_at']             =   now();
        $courses4                           =   Course::create($courses4);


        $courses5['course_name']            =   ['ar' => 'دورة المحلل المالي الكاملة 2020', 'en' => 'The Complete Financial Analyst Course 2020'];
        $courses5['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses5['course_level']            =  1;
        $courses5['course_lang']             =  1;
        $courses5['course_lessons_number']          =  5;
        $courses5['course_lessons_time']            =  "8h  12m";

        $courses5['quantity']               =   $faker->numberBetween(10, 100);
        $courses5['price']                  =   $faker->numberBetween(5, 200);
        $courses5['offer_price']            =   $faker->numberBetween(5, 100);
        $courses5['offer_ends']             =   $faker->dateTime();
        $courses5['sku']                    =   $faker->realText(10);
        $courses5['max_order']              =   $faker->numberBetween(5, 10);
        $courses5['featured']               =   rand(0, 1);
        $courses5['status']                 =   true;
        $courses5['course_category_id']     =   $categories->random();
        $courses5['published_on']           =   $faker->dateTime();
        $courses5['created_by']             =   $faker->realTextBetween(10, 20);
        $courses5['created_at']             =   now();
        $courses5['updated_at']             =   now();
        $courses5                           =   Course::create($courses5);


        $courses6['course_name']            =   ['ar' => 'تصوير الأزياء من المحترفين', 'en' => 'Fashion Photography From Professional'];
        $courses6['description']            =   ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)];

        $courses6['course_level']            =  1;
        $courses6['course_lang']             =  1;
        $courses6['course_lessons_number']          =  5;
        $courses6['course_lessons_time']            =  "8h  12m";

        $courses6['quantity']               =   $faker->numberBetween(10, 100);
        $courses6['price']                  =   $faker->numberBetween(5, 200);
        $courses6['offer_price']            =   $faker->numberBetween(5, 100);
        $courses6['offer_ends']             =   $faker->dateTime();
        $courses6['sku']                    =   $faker->realText(10);
        $courses6['max_order']              =   $faker->numberBetween(5, 10);
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
