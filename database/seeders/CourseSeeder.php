<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Instructor;
use App\Models\User;
use Faker\Factory;
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

        // Get active instructors
        $instructors = Instructor::active()->inRandomOrder()->take(3)->get();

        // Get active lecturer
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'lecturer');
        })->active()->inRandomOrder()->take(10)->get();


        // Get active course categories
        $categories = CourseCategory::active()->pluck('id');

        // Topics list for courses
        $topicsList = [
            [
                "course_topic" => [
                    "ar" => "كن مصممًا لواجهة المستخدم/UX.",
                    "en" => "Become a UI/UX designer."
                ],
            ],
            [
                "course_topic" => [
                    "ar" => "ستكون قادرًا على البدء في كسب مهارات المال.",
                    "en" => "You will be able to start earning money skills."
                ],
            ],
            [
                "course_topic" => [
                    "ar" => "بناء مشروع واجهة المستخدم من البداية إلى النهاية.",
                    "en" => "Build a UI project from beginning to end."
                ],
            ],
            [
                "course_topic" => [
                    "ar" => "العمل مع الألوان والخطوط.",
                    "en" => "Work with colors & fonts."
                ],
            ],

        ];

        // requirements list for courses
        $requirementsList = [
            [
                "course_requirement" => [
                    "ar" => "لا نطلب أي خبرة سابقة أو مهارات محددة مسبقًا لحضور هذه الدورة. سيكون التوجيه الجيد كافيًا لإتقان تصميم واجهة المستخدم/تجربة المستخدم.",
                    "en" => "We do not require any previous experience or pre-defined skills to take this course. A great orientation would be enough to master UI/UX design."
                ],
            ],
            [
                "course_requirement" => [
                    "ar" => "جهاز كمبيوتر مع اتصال جيد بالإنترنت.",
                    "en" => "A computer with a good internet connection."
                ],
            ],
            [
                "course_requirement" => [
                    "ar" => "أدوبي فوتوشوب (اختياري)",
                    "en" => "Adobe Photoshop (OPTIONAL)"
                ],
            ],
        ];

        // Loop through courses data
        $coursesData = [
            [
                'title' => ['ar' => 'تصوير الأزياء من المحترفين', 'en' => 'Fashion Photography From Professional'],
                'course_category_id' => 8, // Assuming category ID 8 is for photography
            ],
            [
                'title' => ['ar' => 'دورة جافا سكريبت الكاملة 2020: بناء مشاريع حقيقية!', 'en' => 'The Complete JavaScript Course 2020: Build Real Projects!'],
                'course_category_id' => 2, // Assuming category ID 2 is for JavaScript
            ],
            [
                'title' => ['ar' => 'دورة جافا سكريبت الكاملة 2020: بناء مشاريع حقيقية!', 'en' => 'The Complete JavaScript Course 2020: Build Real Projects!'],
                'course_category_id' => 5, // Assuming category ID 4 is for programming
            ],
            [
                'title' => ['ar' => 'تعلم الشكل: أساسيات تصميم واجهة المستخدم - تصميم UI/UX', 'en' => 'Learn Figma: User Interface Design Essentials - UI/UX Design'],
                'course_category_id' => 4, // Assuming category ID 4 is for design
            ],
            [
                'title' => ['ar' => 'دورة المحلل المالي الكاملة 2020', 'en' => 'The Complete Financial Analyst Course 2020'],
                'course_category_id' => 1, // Random category
            ],
            [
                'title' => ['ar' => 'تصوير الأزياء من المحترفين', 'en' => 'Fashion Photography From Professional'],
                'course_category_id' => 3, // Random category
            ],
            [
                'title' => ['ar' => 'تصوير الذات', 'en' => 'Self development'],
                'course_category_id' => 6, // Random category
            ],
            [
                'title' => ['ar' => 'تصوير الذات', 'en' => 'Self development'],
                'course_category_id' => 7, // Random category
            ],
            [
                'title' => ['ar' => 'دورة في إدارة الاعمال', 'en' => 'Course in business administration'],
                'course_category_id' => 8, // Random category
            ],
            [
                'title' => ['ar' => 'دورة في التسويق', 'en' => 'Course in marketing'],
                'course_category_id' => $categories->random(), // Random category
            ],
            [
                'title' => ['ar' => 'دورة في الصوت والمسيقي', 'en' => 'A course in voice and music'],
                'course_category_id' => $categories->random(), // Random category
            ],
            [
                'title' => ['ar' => 'دورة في الصوت والمسيقي', 'en' => 'A course in voice and music'],
                'course_category_id' => $categories->random(), // Random category
            ],
            [
                'title' => ['ar' => 'دورة في الصوت والمسيقي', 'en' => 'A course in voice and music'],
                'course_category_id' => $categories->random(), // Random category
            ],
            [
                'title' => ['ar' => 'دورة في الصوت والمسيقي', 'en' => 'A course in voice and music'],
                'course_category_id' => $categories->random(), // Random category
            ],

        ];

        // Loop through each course data and create courses
        foreach ($coursesData as $courseData) {
            $course = Course::create([
                'title' => $courseData['title'],
                'subtitle' => ['ar' => 'عنوان فرعي', 'en' => 'subtitle'],
                'description' => ['ar' => $faker->realText(50), 'en' => $faker->realText(50), 'ca' => $faker->realText(50)],
                'skill_level' => 1,
                'language' => 1,
                'lecture_numbers' => 5,
                'course_duration' => "8h 12m",
                'video_promo' => "https://www.youtube.com/watch?v=9vn_e_XPV4s&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO",
                'video_description' => "https://www.youtube.com/watch?v=N2EfGEPI_q8&list=PL_hXcCj5NytUlkH1XgfsjHAhJ0QHXM_xO&index=4",
                'course_type' => 1,
                'deadline' => "2024-03-11",
                'certificate' => 1,
                'price' => $faker->numberBetween(5, 200),
                'offer_price' => $faker->numberBetween(5, 100),
                'offer_ends' => $faker->dateTime(),
                'featured' => rand(0, 1),
                'status' => true,
                'course_category_id' => $courseData['course_category_id'],
                'published_on' => $faker->dateTime(),
                'created_by' => $faker->realTextBetween(10, 20),
                'updated_by' => $faker->realTextBetween(10, 20), // Assuming you want this as well
            ]);

            // Attach instructors
            $course->instructors()->attach($instructors->pluck('id')->toArray());

            // Shuffle the collection of users
            $shuffledUsers = $users->shuffle();

            // Take the first 3 users from the shuffled collection
            $selectedUsers = $shuffledUsers->take(3);

            // Attach users
            $course->users()->attach($selectedUsers->pluck('id')->toArray());


            // Create topics for the course
            $course->topics()->createMany($topicsList);

            // Create requirements for the course
            $course->requirements()->createMany($requirementsList);
        }
    }
}
