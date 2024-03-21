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

        // Topics list for courses
        // $topicsList = [
        //     [
        //         "course_topic" => [
        //             "ar" => "كن مصممًا لواجهة المستخدم/UX.",
        //             "en" => "Become a UI/UX designer."
        //         ],
        //     ],
        //     [
        //         "course_topic" => [
        //             "ar" => "ستكون قادرًا على البدء في كسب مهارات المال.",
        //             "en" => "You will be able to start earning money skills."
        //         ],
        //     ],
        //     [
        //         "course_topic" => [
        //             "ar" => "بناء مشروع واجهة المستخدم من البداية إلى النهاية.",
        //             "en" => "Build a UI project from beginning to end."
        //         ],
        //     ],
        //     [
        //         "course_topic" => [
        //             "ar" => "العمل مع الألوان والخطوط.",
        //             "en" => "Work with colors & fonts."
        //         ],
        //     ],

        // ];

        // requirements list for courses
        // $requirementsList = [
        //     [
        //         "course_requirement" => [
        //             "ar" => "لا نطلب أي خبرة سابقة أو مهارات محددة مسبقًا لحضور هذه الدورة. سيكون التوجيه الجيد كافيًا لإتقان تصميم واجهة المستخدم/تجربة المستخدم.",
        //             "en" => "We do not require any previous experience or pre-defined skills to take this course. A great orientation would be enough to master UI/UX design."
        //         ],
        //     ],
        //     [
        //         "course_requirement" => [
        //             "ar" => "جهاز كمبيوتر مع اتصال جيد بالإنترنت.",
        //             "en" => "A computer with a good internet connection."
        //         ],
        //     ],
        //     [
        //         "course_requirement" => [
        //             "ar" => "أدوبي فوتوشوب (اختياري)",
        //             "en" => "Adobe Photoshop (OPTIONAL)"
        //         ],
        //     ],
        // ];

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

        ];

        // Loop through each course data and create courses
        foreach ($coursesData as $courseData) {
            $post = Post::create([
                'title' => $courseData['title'],
                'subtitle' => ['ar' => 'عنوان فرعي', 'en' => 'subtitle'],
                'description' => ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)],
                'course_category_id' => $courseData['course_category_id'],

                'video_promo' => "https://www.youtube.com/watch?v=9vn_e_XPV4s&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO",
                'price' => $faker->numberBetween(5, 200),
                'offer_price' => $faker->numberBetween(5, 100),
                'offer_ends' => $faker->dateTime(),

                'start_date' => "2024-02-11",
                'deadline' => "2024-03-11",

                'status' => true,
                'published_on' => $faker->dateTime(),
                'created_by' => $faker->realTextBetween(10, 20),
                'updated_by' => $faker->realTextBetween(10, 20), // Assuming you want this as well
            ]);


            // Create topics for the course
            // $post->topics()->createMany($topicsList);

            // Create requirements for the course
            // $post->requirements()->createMany($requirementsList);
        }
    }
}
