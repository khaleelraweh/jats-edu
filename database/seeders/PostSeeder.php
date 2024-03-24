<?php

namespace Database\Seeders;

use App\Models\CourseCategory;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();

        // Get active course categories
        $categories = CourseCategory::active()->pluck('id');


        // Loop through courses data
        $coursesData = [
            [
                'title' => ['ar' => 'مؤتمر تصميم جديد لصندوق الضوء الأنيق من قطع الورق', 'en' => 'Elegant Light Box Paper Cut Dioramas New Design Conference'],
                'course_category_id' => 1,
            ],
            [
                'title' => ['ar' => 'اكتشف القانون - التحق بأفضل كليات الحقوق في المملكة المتحدة', 'en' => 'Discover Law - Get into the best UK law schools'],
                'course_category_id' => 2,
            ],
            [
                'title' => ['ar' => '"مقدمة في القانون" يوم مفتوح مع بريستو', 'en' => '"Introduction to Law" Open Day with Bristows'],
                'course_category_id' => 3,
            ],
            [
                'title' => ['ar' => 'حماية لامبث: فهم الضرر السياقي', 'en' => 'Lambeth Safeguarding: Understanding Contextual Harm'],
                'course_category_id' => 4,
            ],
            [
                'title' => ['ar' => 'اليوم المفتوح للطلاب الجامعيين - حرم هولواي الجامعي - 3 يوليو 2020', 'en' => 'Undergraduate Open Day – Holloway Campus - 3 July 2020'],
                'course_category_id' => 5,
            ],
            [
                'title' => ['ar' => 'الأحداث المفتوحة للطلاب الجامعيين في جامعة كينجستون 2019-20', 'en' => 'Kingston College undergraduate Open Events 2019-20'],
                'course_category_id' => 6,
            ],
            [
                'title' => ['ar' => 'مؤتمر تصميم جديد لصندوق الضوء الأنيق من قطع الورق', 'en' => 'Elegant Light Box Paper Cut Dioramas New Design Conference'],
                'course_category_id' => 1,
            ],
            [
                'title' => ['ar' => 'اكتشف القانون - التحق بأفضل كليات الحقوق في المملكة المتحدة', 'en' => 'Discover Law - Get into the best UK law schools'],
                'course_category_id' => 2,
            ],
            [
                'title' => ['ar' => '"مقدمة في القانون" يوم مفتوح مع بريستو', 'en' => '"Introduction to Law" Open Day with Bristows'],
                'course_category_id' => 3,
            ],
            [
                'title' => ['ar' => 'حماية لامبث: فهم الضرر السياقي', 'en' => 'Lambeth Safeguarding: Understanding Contextual Harm'],
                'course_category_id' => 4,
            ],
            [
                'title' => ['ar' => 'اليوم المفتوح للطلاب الجامعيين - حرم هولواي الجامعي - 3 يوليو 2020', 'en' => 'Undergraduate Open Day – Holloway Campus - 3 July 2020'],
                'course_category_id' => 5,
            ],
            [
                'title' => ['ar' => 'الأحداث المفتوحة للطلاب الجامعيين في جامعة كينجستون 2019-20', 'en' => 'Kingston College undergraduate Open Events 2019-20'],
                'course_category_id' => 6,
            ],
            [
                'title' => ['ar' => 'مؤتمر تصميم جديد لصندوق الضوء الأنيق من قطع الورق', 'en' => 'Elegant Light Box Paper Cut Dioramas New Design Conference'],
                'course_category_id' => 1,
            ],
            [
                'title' => ['ar' => 'اكتشف القانون - التحق بأفضل كليات الحقوق في المملكة المتحدة', 'en' => 'Discover Law - Get into the best UK law schools'],
                'course_category_id' => 2,
            ],
            [
                'title' => ['ar' => '"مقدمة في القانون" يوم مفتوح مع بريستو', 'en' => '"Introduction to Law" Open Day with Bristows'],
                'course_category_id' => 3,
            ],
            [
                'title' => ['ar' => 'حماية لامبث: فهم الضرر السياقي', 'en' => 'Lambeth Safeguarding: Understanding Contextual Harm'],
                'course_category_id' => 4,
            ],
            [
                'title' => ['ar' => 'اليوم المفتوح للطلاب الجامعيين - حرم هولواي الجامعي - 3 يوليو 2020', 'en' => 'Undergraduate Open Day – Holloway Campus - 3 July 2020'],
                'course_category_id' => 5,
            ],
            [
                'title' => ['ar' => 'الأحداث المفتوحة للطلاب الجامعيين في جامعة كينجستون 2019-20', 'en' => 'Kingston College undergraduate Open Events 2019-20'],
                'course_category_id' => 6,
            ],

        ];

        // Loop through each course data and create courses
        foreach ($coursesData as $courseData) {
            $startDate = $faker->dateTimeBetween('-1 year', 'now');
            $endDate = $faker->dateTimeBetween($startDate, 'now');
            $startTime = $faker->time('H:i:s');
            $endTime = $faker->time('H:i:s');

            $post = Post::create([
                'title' => $courseData['title'],
                'subtitle' => ['ar' => 'عنوان فرعي', 'en' => 'subtitle'],
                'description' => ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)],
                'course_category_id' => $courseData['course_category_id'],

                'video_promo' => "https://www.youtube.com/watch?v=9vn_e_XPV4s&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO",
                'price' => $faker->numberBetween(5, 200),
                'offer_price' => $faker->numberBetween(5, 100),
                'offer_ends' => $faker->dateTime(),

                'start_date' => $startDate,
                'end_date' => $endDate,

                'start_time' => $startTime,
                'end_time' => $endTime,

                'address'  =>  $faker->city . ' , ' . $faker->country(),
                'section'   =>  rand(1, 2),

                'status' => true,
                'published_on' => $faker->dateTime(),
                'created_by' => $faker->realTextBetween(10, 20),
                'updated_by' => $faker->realTextBetween(10, 20), // Assuming you want this as well
            ]);
        }
    }
}
