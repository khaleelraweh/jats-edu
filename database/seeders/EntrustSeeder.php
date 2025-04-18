<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Specialization;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Dictionary :
     *              01- Roles
     *              02- Users
     *              03- AttachRoles To  Users
     *              04- Create random customer and  AttachRole to customerRole
     *
     *
     * @return void
     */
    public function run()
    {

        //create fake information  using faker factory lab
        $faker = Factory::create();
        $specializations = Specialization::query()->pluck('id');


        //------------- 01- Roles ------------//
        //adminRole
        $adminRole = new Role();
        $adminRole->name         = 'admin';
        $adminRole->display_name = 'User Administrator'; // optional
        $adminRole->description  = 'User is allowed to manage and edit other users'; // optional
        $adminRole->allowed_route = 'admin';
        $adminRole->save();

        //supervisorRole
        $supervisorRole = Role::create([
            'name' => 'supervisor',
            'display_name' => 'User Supervisor',
            'description' => 'Supervisor is allowed to manage and edit other users',
            'allowed_route' => 'admin',
        ]);


        //customerRole
        $customerRole = new Role();
        $customerRole->name         = 'customer';
        $customerRole->display_name = 'Project Customer'; // optional
        $customerRole->description  = 'Customer is the customer of a given project'; // optional
        $customerRole->allowed_route = null;
        $customerRole->save();

        //instructorRole
        $instructorRole = new Role();
        $instructorRole->name         = 'instructor';
        $instructorRole->display_name = 'course instructor';
        $instructorRole->description  = 'instructor is the person who  instruct courses';
        $instructorRole->allowed_route = null;
        $instructorRole->save();




        //------------- 02- Users  ------------//
        // Create Admin
        $admin = new User();
        $admin->first_name = 'Admin';
        $admin->last_name = 'System';
        $admin->username = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->email_verified_at = now();
        $admin->mobile = '00967772036131';
        $admin->password = bcrypt('123123123');
        $admin->user_image = 'avator.svg';
        $admin->status = 1;
        $admin->remember_token = Str::random(10);
        $admin->save();

        // Create supervisor
        $supervisor = User::create([
            'first_name' => 'Supervisor',
            'last_name' => 'System',
            'username' => 'supervisor',
            'email' => 'supervisor@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '00967772036132',
            'password' => bcrypt('123123123'),
            'user_image' => 'avator.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);

        // Create customer
        $customer = User::create([
            'first_name' => 'Khaleel',
            'last_name' => 'Raweh',
            'username' => 'khaleel',
            'email' => 'khaleelvisa@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '00967772036133',
            'password' => bcrypt('123123123'),
            'user_image' => 'avator.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);

        // Create customer
        $customer2 = User::create([
            'first_name' => 'naser',
            'last_name' => 'naser',
            'username' => 'naser',
            'email' => 'naser@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '00967772036136',
            'password' => bcrypt('123123123'),
            'user_image' => 'avator.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);

        // create instructor
        $instructor = User::create([
            'first_name' => 'instructor',
            'last_name' => 'person',
            'username' => 'instructor',
            'email' => 'instructor@gmail.com',
            'email_verified_at' => now(),
            'mobile' => '00967772036134',
            'password' => bcrypt('123123123'),
            'user_image' => 'avator.svg',
            'status' => 1,
            'remember_token' => Str::random(10),
        ]);



        //------------- 03- AttachRoles To  Users  ------------//
        $admin->attachRole($adminRole);
        $admin->attachRole($instructorRole);

        $supervisor->attachRole($supervisorRole);
        $supervisor->attachRole($instructorRole);

        $customer->attachRole($customerRole);
        $customer2->attachRole($customerRole);

        $instructor->attachRole($instructorRole);
        $instructor->specializations()->sync($specializations->random(1, 3));



        //------------- 04-  Create random customer and  AttachRole to customerRole  ------------//
        // for ($i = 1; $i <= 20; $i++) {
        //     //Create random customer
        //     $random_customer = User::create([
        //         'first_name' => $faker->firstName,
        //         'last_name' => $faker->lastName,
        //         'username' => $faker->unique()->userName,
        //         'email' => $faker->unique()->email,
        //         'email_verified_at' => now(),
        //         'mobile' => '0096777' . $faker->numberBetween(1000000, 9999999),
        //         'password' => bcrypt('123123123'),
        //         'user_image' => 'avator.svg',
        //         'status' => 1,
        //         'remember_token' => Str::random(10),
        //     ]);

        //     //Add customerRole to RandomCusomer
        //     $random_customer->attachRole($customerRole);
        // } //end for


        //------------- 04-2-  Create random instructor and  AttachRole to instructorRole  ------------//
        // for ($i = 1; $i <= 20; $i++) {
        //     //Create random instructor
        //     $random_instructor = User::create([
        //         'first_name' => $faker->firstName,
        //         'last_name' => $faker->lastName,
        //         'username' => $faker->unique()->userName,
        //         'email' => $faker->unique()->email,
        //         'email_verified_at' => now(),
        //         'mobile' => '0096777' . $faker->numberBetween(1000000, 9999999),
        //         'password' => bcrypt('123123123'),
        //         'user_image' => 'avator.svg',
        //         'status' => 1,
        //         'remember_token' => Str::random(10),
        //         //for instructor info start
        //         'description'          =>   $faker->text(),
        //         'motavation'          =>  $faker->text(),
        //         'facebook'          =>  'www.facebook.com',
        //         'twitter'           =>  'www.twitter.com',
        //         'instagram'         =>  'www.instagram.com',
        //         'linkedin'          =>  'www.linkedin.com',
        //         //for instructor info end
        //     ]);

        //     //Add instructorRole to Randominstructor
        //     $random_instructor->attachRole($instructorRole);

        //     // Add  specializations to Randominstructor
        //     $random_instructor->specializations()->sync($specializations->random(rand(1, 3)));
        // }


        //------------- 05- Permission  ------------//
        //manage main dashboard page
        $manageMain = Permission::create(['name' => 'main', 'display_name' => ['ar' =>  'الرئيسية', 'en'   =>  'Main'], 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'ri-dashboard-line', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();


        //manage Course categories
        $manageCourseCategories = Permission::create(['name' => 'manage_course_categories', 'display_name' => ['ar'    =>  'إدارة الدورات',   'en'    =>  'Manage Courses'], 'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.index', 'icon' => 'fas fa-align-justify', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
        $manageCourseCategories->parent_show = $manageCourseCategories->id;
        $manageCourseCategories->save();
        $showCourseCategories    =  Permission::create(['name' => 'show_course_categories', 'display_name'       =>    ['ar'   =>  'تصنيف الدورات',   'en'    =>  ' Categories'],   'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.index', 'icon' => 'fas fa-align-justify', 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCourseCategories  =  Permission::create(['name' => 'create_course_categories', 'display_name'     =>    ['ar'   =>  'إضافة تصنيف الدورة',   'en'    =>  'Add Course Category'],    'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.create', 'icon' => null, 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayCourseCategories =  Permission::create(['name' => 'display_course_categories', 'display_name'    =>    ['ar'   =>  ' عرض تصنيف الدورة',   'en'    =>  'Display Course Category'],    'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.show', 'icon' => null, 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCourseCategories  =  Permission::create(['name' => 'update_course_categories', 'display_name'     =>    ['ar'   =>  'تعديل تصنيف الدورة',   'en'    =>  'Edit Course Category'],    'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.edit', 'icon' => null, 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCourseCategories  =  Permission::create(['name' => 'delete_course_categories', 'display_name'     =>    ['ar'   =>  'حذف تصنيف الدورة',   'en'    =>  'Delete Course Category'],    'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.destroy', 'icon' => null, 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Manage courses
        $manageCourses = Permission::create(['name' => 'manage_courses', 'display_name' => ['ar'    =>  'الدورات', 'en'    =>  'Courses'], 'route' => 'courses', 'module' => 'courses', 'as' => 'courses.index', 'icon' => 'fas fa-book-open', 'parent' => $manageCourseCategories->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageCourses->parent_show = $manageCourses->id;
        $manageCourses->save();
        $showCourses   =  Permission::create(['name' => 'show_courses',   'display_name'    =>  ['ar'   =>  'عرض الدورات',   'en'       =>  'Courses'],   'route'     => 'courses', 'module'   => 'courses', 'as' =>  'courses.index', 'icon' => 'fas fa-align-justify', 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCourses =  Permission::create(['name' => 'create_courses',   'display_name'    =>  ['ar'   =>  'إضافة دورة جديدة',   'en'    =>  'Add new Course'],   'route'     => 'courses', 'module'  => 'courses', 'as' =>   'courses.create', 'icon' => null, 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCourses =  Permission::create(['name' => 'display_courses',   'display_name'    =>  ['ar'   =>  'عرض دورة',   'en'          =>  'Display Course'],   'route'     => 'courses',  'module'  => 'courses', 'as' =>  'courses.show', 'icon' => null, 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCourses =  Permission::create(['name' => 'update_courses',   'display_name'    =>  ['ar'   =>  'تعديل دورة',   'en'       =>  'Edit Course'],   'route'     => 'courses', 'module'   => 'courses', 'as' =>  'courses.edit', 'icon' => null, 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCourses =  Permission::create(['name' => 'delete_courses',   'display_name'    =>  ['ar'   =>  'حذف دورة',   'en'         =>  'Delete Course'],   'route'     => 'courses', 'module'   => 'courses', 'as' =>  'courses.destroy', 'icon' => null, 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Manage events
        $manageEvents = Permission::create(['name' => 'manage_events', 'display_name' => ['ar'    =>  'الاحداث', 'en'    =>  'Events'], 'route' => 'events', 'module' => 'events', 'as' => 'events.index', 'icon' => 'far fa-calendar-alt', 'parent' => $manageCourseCategories->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '15',]);
        $manageEvents->parent_show = $manageEvents->id;
        $manageEvents->save();
        $showEvents   =  Permission::create(['name' => 'show_events',   'display_name'    =>  ['ar'   =>  'عرض الاحداث',   'en'       =>  'Events'],   'route'     => 'events', 'module'   => 'events', 'as' =>  'events.index', 'icon' => 'far fa-calendar-alt', 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createEvents =  Permission::create(['name' => 'create_events',   'display_name'    =>  ['ar'   =>  'إضافة حدث جديدة',   'en'    =>  'Add new Event'],   'route'     => 'events', 'module'  => 'events', 'as' =>   'events.create', 'icon' => null, 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayEvents =  Permission::create(['name' => 'display_events',   'display_name'    =>  ['ar'   =>  'عرض حدث',   'en'          =>  'Display Event'],   'route'     => 'events',  'module'  => 'events', 'as' =>  'events.show', 'icon' => null, 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateEvents =  Permission::create(['name' => 'update_events',   'display_name'    =>  ['ar'   =>  'تعديل حدث',   'en'       =>  'Edit Event'],   'route'     => 'events', 'module'   => 'events', 'as' =>  'events.edit', 'icon' => null, 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteEvents =  Permission::create(['name' => 'delete_events',   'display_name'    =>  ['ar'   =>  'حذف حدث',   'en'         =>  'Delete Event'],   'route'     => 'events', 'module'   => 'events', 'as' =>  'events.destroy', 'icon' => null, 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Sponsors
        $manageSponsors = Permission::create(['name' => 'manage_sponsors', 'display_name' => ['ar'  =>  'إدارة الجهات التعليمية',    'en'    =>  'Manage Sponsors'], 'route' => 'sponsors', 'module' => 'sponsors', 'as' => 'sponsors.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20',]);
        $manageSponsors->parent_show = $manageSponsors->id;
        $manageSponsors->save();
        $showSponsors      =  Permission::create(['name'  => 'show_sponsors', 'display_name'       =>  ['ar'   =>  'الجهات التعليمية',               'en'    =>  'Sponsors'], 'route' => 'sponsors', 'module' => 'sponsors', 'as' => 'sponsors.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageSponsors->id, 'parent_original' => $manageSponsors->id, 'parent_show' => $manageSponsors->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createSponsors    =  Permission::create(['name'  => 'create_sponsors', 'display_name'     =>  ['ar'   =>  'إنشاء جهة تعليمية',           'en'    =>  'Create new Sponsors'], 'route' => 'sponsors', 'module' => 'sponsors', 'as' => 'sponsors.create', 'icon' => null, 'parent' => $manageSponsors->id, 'parent_original' => $manageSponsors->id, 'parent_show' => $manageSponsors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displaySponsors   =  Permission::create(['name' => 'display_sponsors', 'display_name'    =>  ['ar'   =>  'عرض جهة تعليمية',              'en'    =>  'Display Sponsor'], 'route' => 'sponsors', 'module' => 'sponsors', 'as' => 'sponsors.show', 'icon' => null, 'parent' => $manageSponsors->id, 'parent_original' => $manageSponsors->id, 'parent_show' => $manageSponsors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateSponsors    =  Permission::create(['name' => 'update_sponsors', 'display_name'     =>  ['ar'   =>  'تعديل جهة تعليمية',            'en'    =>  'Edit Sponsor'], 'route' => 'sponsors', 'module' => 'sponsors', 'as' => 'sponsors.edit', 'icon' => null, 'parent' => $manageSponsors->id, 'parent_original' => $manageSponsors->id, 'parent_show' => $manageSponsors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteSponsors    =  Permission::create(['name'  => 'delete_sponsors', 'display_name'     =>  ['ar'   =>  'حذف جهة تعليمية',              'en'    =>  'Delete Sponsor'], 'route' => 'sponsors', 'module' => 'sponsors', 'as' => 'sponsors.destroy', 'icon' => null, 'parent' => $manageSponsors->id, 'parent_original' => $manageSponsors->id, 'parent_show' => $manageSponsors->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Certificates
        $manageCertificates = Permission::create(['name' => 'manage_certificates', 'display_name' => ['ar'  =>  'إدارة الشهائد ',    'en'    =>  'Manage Certificates'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '25',]);
        $manageCertificates->parent_show = $manageCertificates->id;
        $manageCertificates->save();
        $showCertificates      =  Permission::create(['name'  => 'show_certificates', 'display_name'       =>  ['ar'   =>  'الشهائد',               'en'    =>  'Certificates'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCertificates    =  Permission::create(['name'  => 'create_certificates', 'display_name'     =>  ['ar'   =>  'إنشاء شهادة',           'en'    =>  'Create new Certificate'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.create', 'icon' => null, 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCertificates   =  Permission::create(['name' => 'display_certificates', 'display_name'    =>  ['ar'   =>  'عرض شهادة',              'en'    =>  'Display Certificate'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.show', 'icon' => null, 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCertificates    =  Permission::create(['name' => 'update_certificates', 'display_name'     =>  ['ar'   =>  'تعديل شهادة',            'en'    =>  'Edit Certificate'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.edit', 'icon' => null, 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCertificates    =  Permission::create(['name'  => 'delete_certificates', 'display_name'     =>  ['ar'   =>  'حذف شهادة',              'en'    =>  'Delete Certificate'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.destroy', 'icon' => null, 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Certificate Requests
        // $manageCertificateRequests = Permission::create(['name' => 'manage_certificate_requests', 'display_name' => ['ar'  =>  'إدارة طلبات الشهائد ',    'en'    =>  'Manage Certificate Requests'], 'route' => 'certificate_requests', 'module' => 'certificate_requests', 'as' => 'certificate_requests.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
        // $manageCertificateRequests->parent_show = $manageCertificateRequests->id;
        // $manageCertificateRequests->save();
        // $showCertificateReguests      =  Permission::create(['name'  => 'show_certificate_requests', 'display_name'       =>  ['ar'   =>  'طلبات الشهائد',               'en'    =>  'Certificates Requests'], 'route' => 'certificate_requests', 'module' => 'certificate_requests', 'as' => 'certificate_requests.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageCertificateRequests->id, 'parent_original' => $manageCertificateRequests->id, 'parent_show' => $manageCertificateRequests->id, 'sidebar_link' => '1', 'appear' => '1']);
        // $createCertificateReguests    =  Permission::create(['name'  => 'create_certificate_requests', 'display_name'     =>  ['ar'   =>  'إنشاء طلبات الشهائد',           'en'    =>  'Create new Certificate Request'], 'route' => 'certificate_requests', 'module' => 'certificate_requests', 'as' => 'certificate_requests.create', 'icon' => null, 'parent' => $manageCertificateRequests->id, 'parent_original' => $manageCertificateRequests->id, 'parent_show' => $manageCertificateRequests->id, 'sidebar_link' => '1', 'appear' => '0']);
        // $displayCertificateReguests   =  Permission::create(['name' => 'display_certificate_requests', 'display_name'    =>  ['ar'   =>  'عرض طلبات الشهائد',              'en'    =>  'Display Certificate Request'], 'route' => 'certificate_requests', 'module' => 'certificate_requests', 'as' => 'certificate_requests.show', 'icon' => null, 'parent' => $manageCertificateRequests->id, 'parent_original' => $manageCertificateRequests->id, 'parent_show' => $manageCertificateRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $updateCertificateReguests    =  Permission::create(['name' => 'update_certificate_requests', 'display_name'     =>  ['ar'   =>  'تعديل طلبات الشهائد',            'en'    =>  'Edit Certificate Request'], 'route' => 'certificate_requests', 'module' => 'certificate_requests', 'as' => 'certificate_requests.edit', 'icon' => null, 'parent' => $manageCertificateRequests->id, 'parent_original' => $manageCertificateRequests->id, 'parent_show' => $manageCertificateRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $deleteCertificateReguests    =  Permission::create(['name'  => 'delete_certificate_requests', 'display_name'     =>  ['ar'   =>  'حذف طلبات الشهائد',              'en'    =>  'Delete Certificate Request'], 'route' => 'certificate_requests', 'module' => 'certificate_requests', 'as' => 'certificate_requests.destroy', 'icon' => null, 'parent' => $manageCertificateRequests->id, 'parent_original' => $manageCertificateRequests->id, 'parent_show' => $manageCertificateRequests->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Customer Orders
        $manageOrders = Permission::create(['name' => 'manage_orders', 'display_name' => ['ar'  =>  'إدارة الطلبات',    'en'    =>  'Manage Orders'], 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '25',]);
        $manageOrders->parent_show = $manageOrders->id;
        $manageOrders->save();
        $showOrders   =  Permission::create(['name'  => 'show_orders', 'display_name'       =>  ['ar'   =>  'الطلبات',   'en'    =>  'Orders'], 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createOrders =  Permission::create(['name'  => 'create_orders', 'display_name'     =>  ['ar'   =>  'إنشاء طلب ',   'en'    =>  'Create Order'], 'route' => 'orders/create', 'module' => 'orders', 'as' => 'orders.create', 'icon' => null, 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayOrders =  Permission::create(['name' => 'display_orders', 'display_name'    =>  ['ar'   =>  'عرض الطلب',   'en'    =>  'Display Order'], 'route' => 'orders/{orders}', 'module' => 'orders', 'as' => 'orders.show', 'icon' => null, 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateOrders  =  Permission::create(['name' => 'update_orders', 'display_name'     =>  ['ar'   =>  'تعديل الطلب',   'en'    =>  'Edit Order'], 'route' => 'orders/{orders}/edit', 'module' => 'orders', 'as' => 'orders.edit', 'icon' => null, 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteOrders =  Permission::create(['name'  => 'delete_orders', 'display_name'     =>  ['ar'   =>  'حذف الطلب',   'en'    =>  'Delete Order'], 'route' => 'orders/{orders}', 'module' => 'orders', 'as' => 'orders.destroy', 'icon' => null, 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Customers
        $manageCustomers = Permission::create(['name' => 'manage_customers', 'display_name' => ['ar'    =>  'إدارة المستخدمين',  'en' =>  'Manage Users'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user-cog', 'parent' => '0', 'parent_original' => '0',  'sidebar_link' => '1', 'appear' => '1', 'ordering' => '30',]);
        $manageCustomers->parent_show = $manageCustomers->id;
        $manageCustomers->save();
        $showCustomers   =  Permission::create(['name'  => 'show_customers', 'display_name'    => ['ar'   =>     'الطلاب',   'en'    =>  'Stduents'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user-graduate', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCustomers =  Permission::create(['name'  => 'create_customers', 'display_name'    => ['ar'   =>      'إضافة طالب',   'en'    =>  'Add New Student'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.create', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCustomers =  Permission::create(['name' => 'display_customers', 'display_name'     => ['ar'   =>      'عرض طالب',   'en'    =>  'Dsiplay Student'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.show', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCustomers  =  Permission::create(['name' => 'update_customers', 'display_name'     => ['ar'   =>      'تعديل طالب',   'en'    =>  'Edit Student'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.edit', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCustomers =  Permission::create(['name'  => 'delete_customers', 'display_name'    => ['ar'   =>      'حذف طالب',   'en'    =>  'Delete Student'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.destroy', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Supervisor // we can hide suppervisor not to be in sidebar linke by  making in manage_supervisors 'sidebar_link' => '0'
        $manageSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name' => ['ar'    =>  'المشرفين',    'en'    =>  'Supervisors'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-user-tie', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '35',]);
        $manageSupervisors->parent_show = $manageSupervisors->id;
        $manageSupervisors->save();
        $showSupervisors   =  Permission::create(['name' => 'show_supervisors', 'display_name'    =>  ['ar'   =>  'المشرفين',   'en'    =>  'Supervisors'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-user-tie', 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createSupervisors =  Permission::create(['name' => 'create_supervisors', 'display_name'    =>  ['ar'   =>  'إضافة مشرف جديد',   'en'    =>  'Add Supervisor'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.create', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displaySupervisors =  Permission::create(['name' => 'display_supervisors', 'display_name'    =>  ['ar'   =>  'عرض مشرف',   'en'    =>  'Dsiplay Supervisor'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.show', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateSupervisors  =  Permission::create(['name' => 'update_supervisors', 'display_name'    =>  ['ar'   =>  'تعديل مشرف',   'en'    =>  'Edit Supervisor'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.edit', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteSupervisors =  Permission::create(['name' => 'delete_supervisors', 'display_name'    =>  ['ar'   =>  'حذف مشرف',   'en'    =>  'Delete Supervisor'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.destroy', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '0', 'appear' => '0']);

        //instructors
        $manageInstructors = Permission::create(['name' => 'manage_instructors', 'display_name' => ['ar'    =>  'المحاضرين',    'en'    =>  'instructors'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.index', 'icon' => 'fas fa-chalkboard-teacher', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '40',]);
        $manageInstructors->parent_show = $manageInstructors->id;
        $manageInstructors->save();
        $showInstructors   =  Permission::create(['name' => 'show_instructors', 'display_name'    =>  ['ar'   =>  'المحاضرين',   'en'    =>  'instructors'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.index', 'icon' => 'fas fa-chalkboard-teacher', 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createInstructors =  Permission::create(['name' => 'create_instructors', 'display_name'    =>  ['ar'   =>  'إضافة محاضر جديد',   'en'    =>  'Add Instructor'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.create', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayInstructors =  Permission::create(['name' => 'display_instructors', 'display_name'    =>  ['ar'   =>  'عرض محاضر',   'en'    =>  'Dsiplay Instructor'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.show', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateInstructors  =  Permission::create(['name' => 'update_instructors', 'display_name'    =>  ['ar'   =>  'تعديل محاضر',   'en'    =>  'Edit Instructor'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.edit', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteInstructors =  Permission::create(['name' => 'delete_instructors', 'display_name'    =>  ['ar'   =>  'حذف محاضر',   'en'    =>  'Delete Instructor'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.destroy', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);

        //specialization
        $manageSpecializations = Permission::create(['name' => 'manage_specializations', 'display_name' => ['ar'    =>  'التخصصات',    'en'    =>  'specializations'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.index', 'icon' => 'fas fa-file-signature', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '45',]);
        $manageSpecializations->parent_show = $manageSpecializations->id;
        $manageSpecializations->save();
        $showSpecializations   =  Permission::create(['name' => 'show_specializations', 'display_name'    =>  ['ar'   =>  'التخصصات',   'en'    =>  'specializations'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.index', 'icon' => 'fas fa-file-signature', 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createSpecializations =  Permission::create(['name' => 'create_specializations', 'display_name'    =>  ['ar'   =>  'إضافة تخصص جديد',   'en'    =>  'Add specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.create', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displaySpecializations =  Permission::create(['name' => 'display_specializations', 'display_name'    =>  ['ar'   =>  'عرض تخصص',   'en'    =>  'Dsiplay specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.show', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateSpecializations  =  Permission::create(['name' => 'update_specializations', 'display_name'    =>  ['ar'   =>  'تعديل تخصص',   'en'    =>  'Edit specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.edit', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteSpecializations =  Permission::create(['name' => 'delete_specializations', 'display_name'    =>  ['ar'   =>  'حذف تخصص',   'en'    =>  'Delete specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.destroy', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '0', 'appear' => '0']);

        //userAddresses
        // $manageCustomerAddresses = Permission::create(['name' => 'manage_customer_addresses', 'display_name' => ['ar'   => 'إدارة عناوين الطلاب ', 'en'   =>  ' Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
        // $manageCustomerAddresses->parent_show = $manageCustomerAddresses->id;
        // $manageCustomerAddresses->save();
        // $showCustomerAddresses   =  Permission::create(['name'  => 'show_customer_addresses', 'display_name'    =>    ['ar'   =>  'عناوين الطلاب',   'en'    =>  'Customer Addresses'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '1']);
        // $createCustomerAddresses =  Permission::create(['name'  => 'create_customer_addresses', 'display_name'    =>    ['ar'   =>  'إنشاء عنوان جديد',   'en'    =>  'Add Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.create', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);
        // $displayCustomerAddresses =  Permission::create(['name' => 'display_customer_addresses', 'display_name'     =>    ['ar'   =>  'عرض عنوان',   'en'    =>  'Display Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.show', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $updateCustomerAddresses  =  Permission::create(['name' => 'update_customer_addresses', 'display_name'     =>    ['ar'   =>  'تعديل عنوان',   'en'    =>  'Edit Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.edit', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $deleteCustomerAddresses =  Permission::create(['name'  => 'delete_customer_addresses', 'display_name'    =>    ['ar'   =>  'حذف عنوان',   'en'    =>  'Delete Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.destroy', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '0', 'appear' => '0']);

        // TeachRequests
        $manageTeachRequests = Permission::create(['name' => 'manage_teach_requests', 'display_name' => ['ar'  =>  'إدارة طلبات التدريب',    'en'    =>  'Manage Teach Requests'], 'route' => 'teach_requests', 'module' => 'teach_requests', 'as' => 'teach_requests.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '55',]);
        $manageTeachRequests->parent_show = $manageTeachRequests->id;
        $manageTeachRequests->save();
        $showTeachRequests   =  Permission::create(['name'  => 'show_teach_requests', 'display_name'       =>  ['ar'   =>  'طلبات التدريس',   'en'    =>  'Teach Requests'], 'route' => 'teach_requests', 'module' => 'teach_requests', 'as' => 'teach_requests.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createTeachRequests =  Permission::create(['name'  => 'create_teach_requests', 'display_name'     =>  ['ar'   =>  'إنشاء طلب تدريس',   'en'    =>  'Create Teach Request'], 'route' => 'teach_requests', 'module' => 'teach_requests', 'as' => 'teach_requests.create', 'icon' => null, 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayTeachRequests =  Permission::create(['name' => 'display_teach_requests', 'display_name'    =>  ['ar'   =>  'عرض طلب تدريس',   'en'    =>  'Display Teach Request'], 'route' => 'teach_requests', 'module' => 'teach_requests', 'as' => 'teach_requests.show', 'icon' => null, 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateTeachRequests  =  Permission::create(['name' => 'update_teach_requests', 'display_name'     =>  ['ar'   =>  'تعديل طلب تدريس',   'en'    =>  'Edit Teach Request'], 'route' => 'teach_requests', 'module' => 'teach_requests', 'as' => 'teach_requests.edit', 'icon' => null, 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteTeachRequests =  Permission::create(['name'  => 'delete_teach_requests', 'display_name'     =>  ['ar'   =>  'حذف طلب تدريس',   'en'    =>  'Delete Teach Request'], 'route' => 'teach_requests', 'module' => 'teach_requests', 'as' => 'teach_requests.destroy', 'icon' => null, 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Partners
        $managePartners = Permission::create(['name' => 'manage_partners', 'display_name' => ['ar'  =>  'شركاؤنا',    'en'    =>  'Our Partners'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '60',]);
        $managePartners->parent_show = $managePartners->id;
        $managePartners->save();
        $showPartners   =  Permission::create(['name'  => 'show_partners', 'display_name'       =>  ['ar'   =>  'شركاؤنا',   'en'    =>  'Our Partners'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPartners =  Permission::create(['name'  => 'create_partners', 'display_name'     =>  ['ar'   =>  'إنشاء شريك',   'en'    =>  'Create Our Partner'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.create', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayPartners =  Permission::create(['name' => 'display_partners', 'display_name'    =>  ['ar'   =>  'عرض شريك',   'en'    =>  'Display Our Partner'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.show', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePartners  =  Permission::create(['name' => 'update_partners', 'display_name'     =>  ['ar'   =>  'تعديل شريك',   'en'    =>  'Edit Our Partner'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.edit', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePartners =  Permission::create(['name'  => 'delete_partners', 'display_name'     =>  ['ar'   =>  'حذف شريك',   'en'    =>  'Delete Our Partner'], 'route' => 'partners', 'module' => 'partners', 'as' => 'partners.destroy', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);

        // CompanyRequests
        $manageCompanyRequests = Permission::create(['name' => 'manage_company_requests', 'display_name' => ['ar'  =>  'إدارة طلبات الشركات',    'en'    =>  'Manage Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '65',]);
        $manageCompanyRequests->parent_show = $manageCompanyRequests->id;
        $manageCompanyRequests->save();
        $showCompanyRequests   =  Permission::create(['name'  => 'show_company_requests', 'display_name'       =>  ['ar'   =>  'طلبات الشركات',             'en'    =>  'Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCompanyRequests =  Permission::create(['name'  => 'create_company_requests', 'display_name'     =>  ['ar'   =>  'إنشاء طلب شركة جديد',       'en'    =>  'Create new Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.create', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCompanyRequests =  Permission::create(['name' => 'display_company_requests', 'display_name'    =>  ['ar'   =>  'عرض طلب شركة',              'en'    =>  'Display Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.show', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCompanyRequests  =  Permission::create(['name' => 'update_company_requests', 'display_name'     =>  ['ar'   =>  'تعديل طلب شركة',            'en'    =>  'Edit Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.edit', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCompanyRequests =  Permission::create(['name'  => 'delete_company_requests', 'display_name'     =>  ['ar'   =>  'حذف طلب شركة',              'en'    =>  'Delete Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.destroy', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '0', 'appear' => '0']);


        // posts
        $managePosts = Permission::create(['name' => 'manage_posts', 'display_name' => ['ar'  =>  'إدارة الأخبار',    'en'    =>  'Manage News'], 'route' => 'posts', 'module' => 'posts', 'as' => 'posts.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '70',]);
        $managePosts->parent_show = $managePosts->id;
        $managePosts->save();
        $showPosts   =  Permission::create(['name'  => 'show_posts', 'display_name'       =>  ['ar'   =>  'الاخبار',   'en'    =>  'News'], 'route' => 'posts', 'module' => 'posts', 'as' => 'posts.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPosts =  Permission::create(['name'  => 'create_posts', 'display_name'     =>  ['ar'   =>  'إنشاء خبر',   'en'    =>  'Create News'], 'route' => 'posts/create', 'module' => 'posts', 'as' => 'posts.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayPosts =  Permission::create(['name' => 'display_posts', 'display_name'    =>  ['ar'   =>  'عرض خبر',   'en'    =>  'Display News'], 'route' => 'posts/{posts}', 'module' => 'posts', 'as' => 'posts.show', 'icon' => null, 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePosts  =  Permission::create(['name' => 'update_posts', 'display_name'     =>  ['ar'   =>  'تعديل خبر',   'en'    =>  'Edit News'], 'route' => 'posts/{posts}/edit', 'module' => 'posts', 'as' => 'posts.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePosts =  Permission::create(['name'  => 'delete_posts', 'display_name'     =>  ['ar'   =>  'حذف خبر',   'en'    =>  'Delete News'], 'route' => 'posts/{posts}', 'module' => 'posts', 'as' => 'posts.destroy', 'icon' => null, 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '0', 'appear' => '0']);


        //main sliders
        $manageMainSliders = Permission::create(['name' => 'manage_main_sliders', 'display_name' => ['ar'    =>  'إدارة عارض الشرائح', 'en' =>  'Manage Slide Viewer'], 'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.index', 'icon' => 'fas fa-sliders-h', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '75',]);
        $manageMainSliders->parent_show = $manageMainSliders->id;
        $manageMainSliders->save();
        $showMainSliders    =  Permission::create(['name' => 'show_main_sliders', 'display_name'    =>  ['ar'    =>  ' عارض الشرائح الرئيسي',   'en'    =>  'Main Slide Viewer'], 'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.index', 'icon' => 'fas  fa-sliders-h', 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createMainSliders  =  Permission::create(['name' => 'create_main_sliders', 'display_name'    =>  ['ar'    =>  'إضافة شريحة جديد',   'en'    =>  'Add Slide'], 'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.create', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayMainSliders =  Permission::create(['name' => 'display_main_sliders', 'display_name'    =>  ['ar'    =>  'عرض الشريحة',   'en'    =>  'Display Main Slide'],  'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.show', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateMainSliders  =  Permission::create(['name' => 'update_main_sliders', 'display_name'    =>  ['ar'    =>  'تعديل الشريحة',   'en'    =>  'Edit Main Slide'],  'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.edit', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteMainSliders  =  Permission::create(['name' => 'delete_main_sliders', 'display_name'    =>  ['ar'    =>  'حذف الشريحة',   'en'    =>  'Delete Main Slide'],  'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.destroy', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Advertisor sliders
        $manageAdvertisorSliders = Permission::create(['name' => 'manage_advertisor_sliders', 'display_name' => ['ar'    =>  'عارض شرائح الإعلانات', 'en'   =>  'Adv Slide Viewer'], 'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.index', 'icon' => 'fas fa-bullhorn', 'parent' => $manageMainSliders->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '80',]);
        $manageAdvertisorSliders->parent_show = $manageAdvertisorSliders->id;
        $manageAdvertisorSliders->save();
        $showAdvertisorSliders    =  Permission::create(['name' => 'show_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'عارض شرائح الإعلانات',   'en'    =>  'Adv Slide Viewer'], 'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.index', 'icon' => 'fas fa-bullhorn', 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createAdvertisorSliders  =  Permission::create(['name' => 'create_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'إضافة شريحة جديد',   'en'    =>  'Add Adv Slide'], 'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.create', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayAdvertisorSliders =  Permission::create(['name' => 'display_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'عرض الشريحة',   'en'    =>  'Display Adv Slide'],  'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.show', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateAdvertisorSliders  =  Permission::create(['name' => 'update_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'تعديل الشريحة',   'en'    =>  'Edit Adv Slide'],  'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.edit', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteAdvertisorSliders  =  Permission::create(['name' => 'delete_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'حذف الشريحة',   'en'    =>  'Delete Adv Slide'],  'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.destroy', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);




        //web menus
        $manageWebMenus = Permission::create(['name' => 'manage_web_menus', 'display_name' => ['ar' => 'إدارة القوائم', 'en' => 'Manage Menus'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.index', 'icon' => 'fa fa-list-ul', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '85',]);
        $manageWebMenus->parent_show = $manageWebMenus->id;
        $manageWebMenus->save();
        $showWebMenus    =  Permission::create(['name' => 'show_web_menus',  'display_name' => ['ar'     => 'إدارة القائمة الرئيسية', 'en'  =>   'Main Menu'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createWebMenus  =  Permission::create(['name' => 'create_web_menus', 'display_name'  => ['ar'     => 'إضافة رابط', 'en'  =>  'Add Link'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.create', 'icon' => null, 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayWebMenus =  Permission::create(['name' => 'display_web_menus', 'display_name'  => ['ar'     => 'عرض رابط', 'en'  =>  'Display Link'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.show', 'icon' => null, 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateWebMenus  =  Permission::create(['name' => 'update_web_menus', 'display_name'  => ['ar'     => 'تعديل رابط', 'en'  =>  'Edit Link'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.edit', 'icon' => null, 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteWebMenus  =  Permission::create(['name' => 'delete_web_menus', 'display_name'  => ['ar'     => 'حذف رابط', 'en'  =>  'Delete Link'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.destroy', 'icon' => null, 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '0', 'appear' => '0']);


        //company menu
        $manageCompanyMenu = Permission::create(['name' => 'manage_company_menus', 'display_name' => ['ar'    =>  'إدارة قائمة المؤسسة', 'en'   =>  'Company Menu'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '90',]);
        $manageCompanyMenu->parent_show = $manageCompanyMenu->id;
        $manageCompanyMenu->save();
        $showCompanyMenu    =  Permission::create(['name' => 'show_company_menus',  'display_name' => ['ar'  =>  'إدارة قوائم المؤسسة',   'en'    =>  'Manage Company Menu'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCompanyMenu  =  Permission::create(['name' => 'create_company_menus', 'display_name'  => ['ar'  =>  ' إضافة قائمة مؤسسة',   'en'    =>  'Add Company Menu Link'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.create', 'icon' => null, 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayCompanyMenu =  Permission::create(['name' => 'display_company_menus', 'display_name'  => ['ar'  =>  'عرض قائمة مؤسسة',   'en'    =>  'Display Company Menu Link'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.show', 'icon' => null, 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCompanyMenu  =  Permission::create(['name' => 'update_company_menus', 'display_name'  => ['ar'  =>  'تعديل قائمة مؤسسة',   'en'    =>  'Edit Company Menu Link'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.edit', 'icon' => null, 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCompanyMenu  =  Permission::create(['name' => 'delete_company_menus', 'display_name'  => ['ar'  =>  'حذف قائمة مؤسسة',   'en'    =>  'Delete Company Menu Link'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.destroy', 'icon' => null, 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Topics menu
        $manageTopicsMenus = Permission::create(['name' => 'manage_topics_menus', 'display_name' => ['ar'    =>  'إدارة قائمة المواضيع', 'en'   =>  'Topics Menu'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '95',]);
        $manageTopicsMenus->parent_show = $manageTopicsMenus->id;
        $manageTopicsMenus->save();
        $showTopicsMenus    =  Permission::create(['name' => 'show_topics_menus',  'display_name' => ['ar'  =>  'إدارة قائمة المواضيع',   'en'    =>  'Topics Menu'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createTopicsMenus  =  Permission::create(['name' => 'create_topics_menus', 'display_name'  => ['ar'  =>  'إضافة قائمة موضوع',   'en'    =>  'Add Topic Menu Link'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.create', 'icon' => null, 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayTopicsMenus =  Permission::create(['name' => 'display_topics_menus', 'display_name'  => ['ar'  =>  'عرض قائمة موضوع',   'en'    =>  'Display Topic Menu Link'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.show', 'icon' => null, 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateTopicsMenus  =  Permission::create(['name' => 'update_topics_menus', 'display_name'  => ['ar'  =>  'تعديل قائمة موضوع',   'en'    =>  'Edit Topic Menu Link'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.edit', 'icon' => null, 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteTopicsMenus  =  Permission::create(['name' => 'delete_topics_menus', 'display_name'  => ['ar'  =>  'حذف قائمة موضوع',   'en'    =>  'Delete Topic Menu Link'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.destroy', 'icon' => null, 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Tracks menu
        $manageTracksMenus = Permission::create(['name' => 'manage_tracks_menus', 'display_name' => ['ar'    =>  'إدارة قائمة المسارات', 'en'   =>  'Tracks Menu'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '100',]);
        $manageTracksMenus->parent_show = $manageTracksMenus->id;
        $manageTracksMenus->save();
        $showTracksMenus    =  Permission::create(['name' => 'show_tracks_menus',  'display_name' => ['ar'  =>  'إدارة قائمة المسارات',   'en'    =>  'Tracks Menu'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createTracksMenus  =  Permission::create(['name' => 'create_tracks_menus', 'display_name'  => ['ar'  =>  'إضافة قائمة مسار',   'en'    =>  'Add Track Menu Link'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.create', 'icon' => null, 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayTracksMenus =  Permission::create(['name' => 'display_tracks_menus', 'display_name'  => ['ar'  =>  'عرض قائمة مسار',   'en'    =>  'Display Track Menu Link'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.show', 'icon' => null, 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateTracksMenus  =  Permission::create(['name' => 'update_tracks_menus', 'display_name'  => ['ar'  =>  'تعديل قائمة مسار',   'en'    =>  'Edit Track Menu Link'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.edit', 'icon' => null, 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteTracksMenus  =  Permission::create(['name' => 'delete_tracks_menus', 'display_name'  => ['ar'  =>  'حذف قائمة مسار',   'en'    =>  'Delete Track Menu Link'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.destroy', 'icon' => null, 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Support menu
        $manageSupportMenus = Permission::create(['name' => 'manage_support_menus', 'display_name' => ['ar'    =>  'إدارة قائمة الدعم', 'en'   =>  'Support Menu'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '105',]);
        $manageSupportMenus->parent_show = $manageSupportMenus->id;
        $manageSupportMenus->save();
        $showSupportMenus    =  Permission::create(['name' => 'show_support_menus',  'display_name' => ['ar'  =>  'إدارة قائمة الدعم',   'en'    =>  'Support Menu'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createSupportMenus  =  Permission::create(['name' => 'create_support_menus', 'display_name'  => ['ar'  =>  'إضافة قامة دعم',   'en'    =>  'Add Support Menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.create', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displaySupportMenus =  Permission::create(['name' => 'display_support_menus', 'display_name'  => ['ar'  =>  'عرض قامة دعم',   'en'    =>  'Display Support Menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.show', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateSupportMenus  =  Permission::create(['name' => 'update_support_menus', 'display_name'  => ['ar'  =>  'تعديل قامة دعم',   'en'    =>  'Edit Support Menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.edit', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteSupportMenus  =  Permission::create(['name' => 'delete_support_menus', 'display_name'  => ['ar'  =>  'حذف قامة دعم',   'en'    =>  'Delete Support Menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.destroy', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Policies and privacy menu
        $managePolicyPrivacyMenus = Permission::create(['name' => 'manage_policy_privacy_menus', 'display_name' => ['ar'    =>  'إدارة قائمة السياسات', 'en'   =>  'Policy Privacy Menu'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '105',]);
        $managePolicyPrivacyMenus->parent_show = $managePolicyPrivacyMenus->id;
        $managePolicyPrivacyMenus->save();
        $showPolicyPrivacy    =  Permission::create(['name' => 'show_policy_privacy_menus',  'display_name' => ['ar'  =>  'إدارة قائمة السياسات',   'en'    =>  'Policy Privacy Menu'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.index', 'icon' => 'fas fa-bars', 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPolicyPrivacy  =  Permission::create(['name' => 'create_policy_privacy_menus', 'display_name'  => ['ar'  =>  'إضافة قامة السياسات',   'en'    =>  'Add Policy Privacy Menu Link'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.create', 'icon' => null, 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayPolicyPrivacy =  Permission::create(['name' => 'display_policy_privacy_menus', 'display_name'  => ['ar'  =>  'عرض قامة السياسات',   'en'    =>  'Display Policy Privacy Menu Link'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.show', 'icon' => null, 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePolicyPrivacy  =  Permission::create(['name' => 'update_policy_privacy_menus', 'display_name'  => ['ar'  =>  'تعديل قامة السياسات',   'en'    =>  'Edit Policy Privacy Menu Link'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.edit', 'icon' => null, 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePolicyPrivacy  =  Permission::create(['name' => 'delete_policy_privacy_menus', 'display_name'  => ['ar'  =>  'حذف قامة السياسات',   'en'    =>  'Delete Policy Privacy Menu Link'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.destroy', 'icon' => null, 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '0', 'appear' => '0']);


        //web menu helper
        // $manageWebMenuHelps = Permission::create(['name' => 'manage_web_menu_helps', 'display_name' => ['ar'    =>  'إدارة قائمة المساعدة', 'en'   =>  'Helps Menu'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.index', 'icon' => 'fa fa-question', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '110',]);
        // $manageWebMenuHelps->parent_show = $manageWebMenuHelps->id;
        // $manageWebMenuHelps->save();
        // $showWebMenuHelps    =  Permission::create(['name' => 'show_web_menu_helps',  'display_name' => ['ar'  =>  'إدارة قوائم المساعدة',   'en'    =>  'Helps Menu'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.index', 'icon' => 'fa fa-question', 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '1', 'appear' => '1']);
        // $createWebMenuHelps  =  Permission::create(['name' => 'create_web_menu_helps', 'display_name'  => ['ar'  =>  'إضافة قائمة مساعدة',   'en'    =>  'Add Help Menu Link'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.create', 'icon' => null, 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $displayWebMenuHelps =  Permission::create(['name' => 'display_web_menu_helps', 'display_name'  => ['ar'  =>  'عرض قائمة مساعدة',   'en'    =>  'Display Help Menu Link'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.show', 'icon' => null, 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $updateWebMenuHelps  =  Permission::create(['name' => 'update_web_menu_helps', 'display_name'  => ['ar'  =>  'تعديل قائمة مساعدة',   'en'    =>  'Edit Help Menu Link'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.edit', 'icon' => null, 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $deleteWebMenuHelps  =  Permission::create(['name' => 'delete_web_menu_helps', 'display_name'  => ['ar'  =>  'حذف قائمة مساعدة',   'en'    =>  'Delete Help Menu Link'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.destroy', 'icon' => null, 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '0', 'appear' => '0']);

        //pages
        $managePages = Permission::create(['name' => 'manage_pages', 'display_name' => ['ar' => 'إدارة الصفحات', 'en' => 'Manage Pages'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.index', 'icon' => 'far fa-file-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '115',]);
        $managePages->parent_show = $managePages->id;
        $managePages->save();
        $showPages    =  Permission::create(['name' => 'show_pages',  'display_name' => ['ar'     => 'إدارة الصفحة ', 'en'  =>   'Main Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.index', 'icon' => 'far fa-file-alt', 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPages  =  Permission::create(['name' => 'create_pages', 'display_name'  => ['ar'     => 'إضافة صفحة', 'en'  =>  'Add Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.create', 'icon' => null, 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayPages =  Permission::create(['name' => 'display_pages', 'display_name'  => ['ar'     => 'عرض صفحة', 'en'  =>  'Display Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.show', 'icon' => null, 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePages  =  Permission::create(['name' => 'update_pages', 'display_name'  => ['ar'     => 'تعديل صفحة', 'en'  =>  'Edit Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.edit', 'icon' => null, 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePages  =  Permission::create(['name' => 'delete_pages', 'display_name'  => ['ar'     => 'حذف صفحة', 'en'  =>  'Delete Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.destroy', 'icon' => null, 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '0', 'appear' => '0']);




        //Manage call_actions
        $manageCallActions = Permission::create(['name' => 'manage_call_actions', 'display_name' => ['ar'    =>  'إدارة الإعلانات', 'en'    =>  'Manage Advertisements'], 'route' => 'call_actions', 'module' => 'call_actions', 'as' => 'call_actions.index', 'icon' => 'far fa-calendar-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '120',]);
        $manageCallActions->parent_show = $manageCallActions->id;
        $manageCallActions->save();
        $showCallActions   =  Permission::create(['name' => 'show_call_actions',   'display_name'    =>  ['ar'   =>  'عرض  الإعلانات',   'en'       =>  'Advertisements'],   'route'     => 'call_actions', 'module'   => 'call_actions', 'as' =>  'call_actions.index', 'icon' => 'far fa-calendar-alt', 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCallActions =  Permission::create(['name' => 'create_call_actions',   'display_name'    =>  ['ar'   =>  'إضافة إعلان  جديد',   'en'    =>  'Add new Advertisement'],   'route'     => 'call_actions', 'module'  => 'call_actions', 'as' =>   'call_actions.create', 'icon' => null, 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCallActions =  Permission::create(['name' => 'display_call_actions',   'display_name'    =>  ['ar'   =>  'عرض الإعلانات',   'en'          =>  'Display Advertisements'],   'route'     => 'call_actions',  'module'  => 'call_actions', 'as' =>  'call_actions.show', 'icon' => null, 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCallActions =  Permission::create(['name' => 'update_call_actions',   'display_name'    =>  ['ar'   =>  'تعديل إعلان',   'en'       =>  'Edit Advertisement'],   'route'     => 'call_actions', 'module'   => 'call_actions', 'as' =>  'call_actions.edit', 'icon' => null, 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCallActions =  Permission::create(['name' => 'delete_call_actions',   'display_name'    =>  ['ar'   =>  'حذف إعلان',   'en'         =>  'Delete Advertisement'],   'route'     => 'call_actions', 'module'   => 'call_actions', 'as' =>  'call_actions.destroy', 'icon' => null, 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '0', 'appear' => '0']);



        //Reviews
        $manageReviews = Permission::create(['name' => 'manage_reviews', 'display_name' => ['ar' =>  'إدارة التعليقات',  'en'    =>  'Manage Reviews'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '125',]);
        $manageReviews->parent_show = $manageReviews->id;
        $manageReviews->save();
        $showReviews   =  Permission::create(['name' => 'show_reviews',  'display_name'      =>  ['ar'   =>  'التعليقات',   'en'    =>  'Reviews'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.index', 'icon' => 'fas fa-comment', 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createReviews =  Permission::create(['name' => 'create_reviews', 'display_name'     =>  ['ar'   =>  'إضافة تعليق',   'en'    =>  'Create Review'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.create', 'icon' => null, 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayReviews =  Permission::create(['name' => 'display_reviews', 'display_name'   =>  ['ar'   =>  'عرض تعليق',   'en'    =>  'Display Review'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.show', 'icon' => null, 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateReviews  =  Permission::create(['name' => 'update_reviews', 'display_name'    =>  ['ar'   =>  'تعديل تعليق',   'en'    =>  'Edit Review'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.edit', 'icon' => null, 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteReviews =  Permission::create(['name' => 'delete_reviews', 'display_name'     =>  ['ar'   =>  'حذف تعليق',   'en'    =>  'Delete Review'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.destroy', 'icon' => null, 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Tags
        $manageTags = Permission::create(['name' => 'manage_tags', 'display_name' => ['ar'  =>  'إدارة الكلمات المفتاحية',  'en'    =>  'Manage Tags'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '130',]);
        $manageTags->parent_show = $manageTags->id;
        $manageTags->save();
        $showTags    =  Permission::create(['name' => 'show_tags',  'display_name' =>   ['ar'   =>  ' الكلمات المفتاحية',   'en'        =>  'Tags'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createTags  =  Permission::create(['name' => 'create_tags', 'display_name'  =>   ['ar'   =>  'إضافة كلمة مفتاحية',   'en'       =>  'Add New Tag'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.create', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayTags =  Permission::create(['name' => 'display_tags', 'display_name'  =>   ['ar'   =>  'استعراض كلمة مفتاحية',   'en'      =>  'Display Tag'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.show', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateTags  =  Permission::create(['name' => 'update_tags', 'display_name'  =>   ['ar'   =>  'تعديل كلمة مفتاحية',   'en'        =>  'Update Tag'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.edit', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteTags  =  Permission::create(['name' => 'delete_tags', 'display_name'  =>   ['ar'   =>  'حذف لكمة مفتاحية',   'en'          =>  'Delete Tag'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.destroy', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Coupons
        $manageCoupons = Permission::create(['name' => 'manage_coupons', 'display_name' => ['ar'    =>  'إدارة كوبونات الخصم', 'en' =>  'Manage Coupons'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.index', 'icon' => 'fas fa-percent', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '135',]);
        $manageCoupons->parent_show = $manageCoupons->id;
        $manageCoupons->save();
        $showProductCoupons    =  Permission::create(['name' => 'show_coupons',  'display_name' =>  ['ar'   =>  'كوبونات الخصم',   'en'    =>  'Coupons'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.index', 'icon' => 'fas fa-percent', 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createProductCoupons  =  Permission::create(['name' => 'create_coupons', 'display_name'  =>  ['ar'   =>  'إنشاء كوبون ',   'en'    =>  'Add New Coupon'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.create', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayProductCoupons =  Permission::create(['name' => 'display_coupons', 'display_name'  =>  ['ar'   =>  'عرض كوبون',   'en'    =>  'Display Coupon'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.show', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateProductCoupons  =  Permission::create(['name' => 'update_coupons', 'display_name'  =>  ['ar'   =>  'تعديل كوبون',   'en'    =>  'Edit Coupon'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.edit', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteProductCoupons  =  Permission::create(['name' => 'delete_coupons', 'display_name'  =>  ['ar'   =>  'حذف كوبون',   'en'    =>  'Delete Coupon'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.destroy', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '0', 'appear' => '0']);

        // page visits
        $manageInstPageVisit = Permission::create(['name' => 'manage_inst_page_visit', 'display_name' => ['ar'  =>  'إدارة الزيارات',    'en'    =>  'Manage Page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
        $manageInstPageVisit->parent_show = $manageInstPageVisit->id;
        $manageInstPageVisit->save();
        $showInstPageVisit      =  Permission::create(['name'  => 'show_inst_page_visit', 'display_name'       =>  ['ar'   =>  'الزيارات',               'en'    =>  'Page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createInstPageVisit    =  Permission::create(['name'  => 'create_inst_page_visit', 'display_name'     =>  ['ar'   =>  'إنشاء زيارة',           'en'    =>  'Create new Page Visti'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.create', 'icon' => null, 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayInstPageVisit   =  Permission::create(['name' => 'display_inst_page_visit', 'display_name'    =>  ['ar'   =>  'عرض زيارة',              'en'    =>  'Display Page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.show', 'icon' => null, 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateInstPageVisit    =  Permission::create(['name' => 'update_inst_page_visit', 'display_name'     =>  ['ar'   =>  'تعديل زيارة',            'en'    =>  'Edit Page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.edit', 'icon' => null, 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteInstPageVisit    =  Permission::create(['name'  => 'delete_inst_page_visit', 'display_name'     =>  ['ar'   =>  'حذف زيارة',              'en'    =>  'Delete page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.destroy', 'icon' => null, 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '0', 'appear' => '0']);

        //manage Document Archives
        // $manageDocumentArchives = Permission::create(['name' => 'manage_document_archives', 'display_name' => ['ar'    =>  'إدارة الإرشيف',   'en'    =>  'Manage Archives'], 'route' => 'document_archives', 'module' => 'document_archives', 'as' => 'document_archives.index', 'icon' => 'fas fa-folder-minus', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '100',]);
        // $manageDocumentArchives->parent_show = $manageDocumentArchives->id;
        // $manageDocumentArchives->save();
        // $showDocumentArchives    =  Permission::create(['name' => 'show_document_archives', 'display_name'       =>    ['ar'   =>  'إرشيف الوثائق',   'en'    =>  ' Document Archives'],   'route' => 'document_archives', 'module' => 'document_archives', 'as' => 'document_archives.index', 'icon' => 'fas fa-folder-minus', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        // $createDocumentArchives  =  Permission::create(['name' => 'create_document_archives', 'display_name'     =>    ['ar'   =>  'إضافة إرشيف وثيقة جديد',   'en'    =>  'Add Document Archive'],    'route' => 'document_archives', 'module' => 'document_archives', 'as' => 'document_archives.create', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        // $displayDocumentArchives =  Permission::create(['name' => 'display_document_archives', 'display_name'    =>    ['ar'   =>  ' عرض إرشيف وثيقة',   'en'    =>  'Display Document Archive'],    'route' => 'document_archives', 'module' => 'document_archives', 'as' => 'document_archives.show', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        // $updateDocumentArchives  =  Permission::create(['name' => 'update_document_archives', 'display_name'     =>    ['ar'   =>  'تعديل إرشيف وثيقة',   'en'    =>  'Edit Document Archive'],    'route' => 'document_archives', 'module' => 'document_archives', 'as' => 'document_archives.edit', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);
        // $deleteDocumentArchives  =  Permission::create(['name' => 'delete_document_archives', 'display_name'     =>    ['ar'   =>  'حذف إرشيف وثيقة',   'en'    =>  'Delete Document Archive'],    'route' => 'document_archives', 'module' => 'document_archives', 'as' => 'document_archives.destroy', 'icon' => null, 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '0']);

        //Countries
        // $manageCountries = Permission::create(['name' => 'manage_countries', 'display_name' => ['ar'  =>  'إدارة البلدان',   'en'    =>  'Manage Countries'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '140',]);
        // $manageCountries->parent_show = $manageCountries->id;
        // $manageCountries->save();
        // $showCountries   =  Permission::create(['name'     => 'show_countries', 'display_name'  => ['ar'   =>  'الدول',   'en'    =>  'Countries'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '1']);
        // $createCountries =  Permission::create(['name'     => 'create_countries', 'display_name'  => ['ar'   =>  'إضافة دولة',   'en'    =>  'Add Country'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.create', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);
        // $displayCountries =  Permission::create(['name'     => 'display_countries', 'display_name'  => ['ar'   =>  'عرض بيانات الدولة',   'en'    =>  'Display Country'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.show', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $updateCountries  =  Permission::create(['name'     => 'update_countries', 'display_name'  => ['ar'   =>  'تعديل بيانات الدولة',   'en'    =>  'Edit Country'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.edit', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $deleteCountries =  Permission::create(['name'     => 'delete_countries', 'display_name'  => ['ar'   =>  'حذف الدولة',   'en'    =>  'Delete Country'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.destroy', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '0', 'appear' => '0']);

        //States
        // $manageStates = Permission::create(['name' => 'manage_states', 'display_name' => ['ar' =>   'المحافظات',    'en'    =>  'States'], 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker-alt', 'parent' =>  $manageCountries->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '145',]);
        // $manageStates->parent_show = $manageStates->id;
        // $manageStates->save();
        // $showStates     =  Permission::create(['name' => 'show_states', 'display_name'    => ['ar'  =>  'المحافظات',    'en'    =>  'States'], 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker-alt', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '1']);
        // $createStates   =  Permission::create(['name' => 'create_states', 'display_name'        =>  ['ar'   =>  'إضافة محافظة',   'en'    =>  'Create State'], 'route' => 'states', 'module' => 'states', 'as' => 'states.create', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);
        // $displayStates  =  Permission::create(['name' => 'display_states', 'display_name'       =>  ['ar'   =>  'عرض محافظة',   'en'    =>  'Display State'], 'route' => 'states', 'module' => 'states', 'as' => 'states.show', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $updateStates   =  Permission::create(['name' => 'update_states', 'display_name'        =>  ['ar'   =>  'تعديل محافظة',   'en'    =>  'Edit State'], 'route' => 'states', 'module' => 'states', 'as' => 'states.edit', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $deleteStates   =  Permission::create(['name' => 'delete_states', 'display_name'        =>  ['ar'   =>  'حذف المحافظة',   'en'    =>  'Delete State'], 'route' => 'states', 'module' => 'states', 'as' => 'states.destroy', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Cities
        // $manageCities = Permission::create(['name' => 'manage_cities', 'display_name' =>    ['ar'   =>  'المدن',   'en'    =>  'Cities'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' =>  $manageCountries->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '150',]);
        // $manageCities->parent_show = $manageCities->id;
        // $manageCities->save();
        // $showCities     =  Permission::create(['name' => 'show_cities', 'display_name'          =>  ['ar'   =>  'المدن',           'en' =>  'Cities'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '1']);
        // $createCities   =  Permission::create(['name' => 'create_cities', 'display_name'        =>  ['ar'   =>  'إضافة مدينة',     'en' =>  'Create City'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.create', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);
        // $displayCities  =  Permission::create(['name' => 'display_cities', 'display_name'       =>  ['ar'   =>  'عرض مدينة',       'en' =>  'Display City'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.show', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $updateCities   =  Permission::create(['name' => 'update_cities', 'display_name'        =>  ['ar'   =>  'تعديل المدينة',   'en' =>  'Edit City'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.edit', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '0', 'appear' => '0']);
        // $deleteCities   =  Permission::create(['name' => 'delete_cities', 'display_name'        =>  ['ar'   =>  'حذف المدينة',     'en' =>  'Delete City'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.destroy', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Shipping Companies
        $manageShippingCompanies = Permission::create(['name' => 'manage_shipping_companies', 'display_name' => ['ar'   =>  'إدارة شركات الشحن',    'en'    =>  'Shipping Company'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '1', 'ordering' => '160',]);
        $manageShippingCompanies->parent_show = $manageShippingCompanies->id;
        $manageShippingCompanies->save();
        $showShippingCompanies   =  Permission::create(['name'  => 'show_shipping_companies', 'display_name'        =>  ['ar'   =>  'شركات الشحن',   'en'    =>  'Shipping Company'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createShippingCompanies =  Permission::create(['name'  => 'create_shipping_companies', 'display_name'      =>  ['ar'   =>  'إضافة شركة شحن',   'en'    =>  'Create Shipping Compnay'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.create', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayShippingCompanies =  Permission::create(['name'  => 'display_shipping_companies', 'display_name'    =>  ['ar'   =>  'عرض شركة الشحن',   'en'    =>  'Display Shipping Compnay'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.show', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateShippingCompanies =  Permission::create(['name'  => 'update_shipping_companies', 'display_name'      =>  ['ar'   =>  'تعديل شركة الشحن',   'en'    =>  'Edit Shipping Compnay'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.edit', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteShippingCompanies =  Permission::create(['name'  => 'delete_shipping_companies', 'display_name'      =>  ['ar'   =>  'حذف شركة الشحن',   'en'    =>  'Delete Shipping Compnay'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.destroy', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '0', 'appear' => '0']);




        //payment Categories
        $managePaymentCategories = Permission::create(['name' => 'manage_payment_categories', 'display_name' => ['ar'   =>  'إدارة تصنيف طرق الدفع',   'en'    =>  'payment Categories'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '165',]);
        $managePaymentCategories->parent_show = $managePaymentCategories->id;
        $managePaymentCategories->save();
        $showPaymentCategories    =  Permission::create(['name' => 'show_payment_categories',  'display_name'   =>  ['ar'   =>  'تصنيف طرق الدفع',   'en'    =>  'Payment Categories'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPaymentCategories  =  Permission::create(['name' => 'create_payment_categories', 'display_name'  =>  ['ar'   =>  'إضافة تصيف طريقة دفع',   'en'    =>  'Create Payment Category'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.create', 'icon' => null, 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayPaymentCategories =  Permission::create(['name' => 'display_payment_categories', 'display_name' =>  ['ar'   =>  'عرض تصنيف طريقة دفع',   'en'    =>  'Display Payment Category'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.show', 'icon' => null, 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePaymentCategories  =  Permission::create(['name' => 'update_payment_categories', 'display_name'  =>  ['ar'   =>  'تعديل تصنيف طريقة دفع',   'en'    =>  'Edit Payment Category'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.edit', 'icon' => null, 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePaymentCategories  =  Permission::create(['name' => 'delete_payment_categories', 'display_name'  =>  ['ar'   =>  'حذف تصنيف طريقة دفع',   'en'    =>  'Delete Payment Category'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.destroy', 'icon' => null, 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Payment Methods
        $managePaymentMethods = Permission::create(['name' => 'manage_payment_methods', 'display_name' => ['ar' =>  'بوابات الدفع',    'en'    =>  'Payment Gateways'], 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.index', 'icon' => 'fas fa-dollar-sign', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '1', 'ordering' => '170',]);
        $managePaymentMethods->parent_show = $managePaymentMethods->id;
        $managePaymentMethods->save();
        $showPaymentMethods   =  Permission::create(['name'  => 'show_payment_methods', 'display_name'          =>  ['ar'   =>  'بوابات الدفع',   'en'    =>  'Payment Gateways'], 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.index', 'icon' => 'fas fa-dollar-sign', 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPaymentMethods =  Permission::create(['name'  => 'create_payment_methods', 'display_name'        =>  ['ar'   =>  'إضافة بوابة دفع',   'en'    =>  'Create Payment Gateway'], 'route' => 'payment_methods/create', 'module' => 'payment_methods', 'as' => 'payment_methods.create', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayPaymentMethods =  Permission::create(['name'  => 'display_payment_methods', 'display_name'      =>  ['ar'   =>  'عرض بوابة دفع',   'en'    =>  'Display Payment Gateway'], 'route' => 'payment_methods/{payment_methods}', 'module' => 'payment_methods', 'as' => 'payment_methods.show', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePaymentMethods =  Permission::create(['name'  => 'update_payment_methods', 'display_name'        =>  ['ar'   =>  'تعديل  بوابة الدفع',   'en'    =>  'Edit Payment Gateway'], 'route' => 'payment_methods/{payment_methods}/edit', 'module' => 'payment_methods', 'as' => 'payment_methods.edit', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePaymentMethods =  Permission::create(['name'  => 'delete_payment_methods', 'display_name'        =>  ['ar'   =>  'حذف بوابة الدفع',   'en'    =>  'Delete Payment Gateway'], 'route' => 'payment_methods/{payment_methods}', 'module' => 'payment_methods', 'as' => 'payment_methods.destroy', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '0', 'appear' => '0']);


        //payment methodOffline
        $managePaymentMethodOfflines = Permission::create(['name' => 'manage_payment_method_offlines', 'display_name' => ['ar'  =>  'طرق الدفع',    'en'    =>  'Payment Methods'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.index', 'icon' => 'fa fa-list-ul', 'parent' => $managePaymentCategories->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '175',]);
        $managePaymentMethodOfflines->parent_show = $managePaymentMethodOfflines->id;
        $managePaymentMethodOfflines->save();
        $showPaymentMethodOfflines    =  Permission::create(['name' => 'show_payment_method_offlines',  'display_name'      =>  ['ar'   =>  'طرق الدفع',   'en'    =>  'Payment Methods Online'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.index', 'icon' => 'fa fa-list-ul', 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPaymentMethodOfflines  =  Permission::create(['name' => 'create_payment_method_offlines', 'display_name'     =>  ['ar'   =>  'إضافة طريقة دفع ',   'en'    =>  'Create Payment Method'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.create', 'icon' => null, 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayPaymentMethodOfflines =  Permission::create(['name' => 'display_payment_method_offlines', 'display_name'    =>  ['ar'   =>  'عرض طريقة دفع',   'en'    =>  'Display Payment Method'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.show', 'icon' => null, 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePaymentMethodOfflines  =  Permission::create(['name' => 'update_payment_method_offlines', 'display_name'     =>  ['ar'   =>  'تعديل طريقة الدفع',   'en'    =>  'Edit Payment Method'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.edit', 'icon' => null, 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePaymentMethodOfflines  =  Permission::create(['name' => 'delete_payment_method_offlines', 'display_name'     =>  ['ar'   =>  'حذف طريقة الدفع',   'en'    =>  'Delete Payment Method'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.destroy', 'icon' => null, 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Site Settings Holder
        $manageSiteSettings = Permission::create(['name' => 'manage_site_settings', 'display_name' => ['ar' =>  'الاعدادات العامة', 'en'    =>  'General Settings'], 'route' => 'settings', 'module' => 'settings', 'as' => 'settings.index', 'icon' => 'fa fa-cog', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '180',]);
        $manageSiteSettings->parent_show = $manageSiteSettings->id;
        $manageSiteSettings->save();

        //currencies
        $manageCurrencies = Permission::create(['name' => 'manage_currencies', 'display_name' => ['ar'  =>  'إدارة العملات', 'en'  =>  'Manage Currencies'], 'route' => 'currencies', 'module' => 'currencies', 'as' => 'currencies.index', 'icon' => 'fas fa-money-bill-alt', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '185',]);
        $manageCurrencies->parent_show = $manageCurrencies->id;
        $manageCurrencies->save();
        $showCurrencies    =  Permission::create(['name' => 'show_currencies', 'display_name'       =>  ['ar'   =>  'العملات',   'en'    =>  'Currencies'], 'route' => 'currencies', 'module' => 'currencies', 'as' => 'currencies.index', 'icon' => 'fas fa-money-bill-alt', 'parent' => $manageCurrencies->id, 'parent_original' => $manageCurrencies->id, 'parent_show' => $manageCurrencies->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCurrencies  =  Permission::create(['name' => 'create_currencies', 'display_name'     =>  ['ar'   =>  'إضافة عملة',   'en'    =>  'Create Currency'], 'route' => 'currencies', 'module' => 'currencies', 'as' => 'currencies.create', 'icon' => null, 'parent' => $manageCurrencies->id, 'parent_original' => $manageCurrencies->id, 'parent_show' => $manageCurrencies->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayCurrencies =  Permission::create(['name' => 'display_currencies', 'display_name'    =>  ['ar'   =>  'عرض العملة',   'en'    =>  'Display Currency'],  'route' => 'currencies', 'module' => 'currencies', 'as' => 'currencies.show', 'icon' => null, 'parent' => $manageCurrencies->id, 'parent_original' => $manageCurrencies->id, 'parent_show' => $manageCurrencies->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCurrencies  =  Permission::create(['name' => 'update_currencies', 'display_name'     =>  ['ar'   =>  'تعديل العملة',   'en'    =>  'Edit Currency'],  'route' => 'currencies', 'module' => 'currencies', 'as' => 'currencies.edit', 'icon' => null, 'parent' => $manageCurrencies->id, 'parent_original' => $manageCurrencies->id, 'parent_show' => $manageCurrencies->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCurrencies  =  Permission::create(['name' => 'delete_currencies', 'display_name'     =>  ['ar'   =>  'حذف العملة',   'en'    =>  'Delete Currency'],  'route' => 'currencies', 'module' => 'currencies', 'as' => 'currencies.destroy', 'icon' => null, 'parent' => $manageCurrencies->id, 'parent_original' => $manageCurrencies->id, 'parent_show' => $manageCurrencies->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Site Infos
        $displaySiteInfos =  Permission::create(['name' => 'display_site_infos', 'display_name'     => ['ar'   =>  'إدارة  بيانات الموقع', 'en'  =>  'Manage Site Infos'], 'route' => 'settings.site_main_infos', 'module' => 'settings.site_main_infos', 'as' => 'settings.site_main_infos.show', 'icon' => 'fa fa-info-circle', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        $updateSiteInfos  =  Permission::create(['name' => 'update_site_infos', 'display_name'      => ['ar'    =>  'تعديل بيانات الموقع', 'en'    =>  'Edit Site Infos'], 'route' => 'settings.site_main_infos', 'module' => 'settings.site_main_infos', 'as' => 'settings.site_main_infos.edit', 'icon' => null, 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Site Contacts
        $displaySiteContacts =  Permission::create(['name' => 'display_site_contacts', 'display_name'   => ['ar'    =>  'إدارة  بيانات الإتصال ', 'en' =>  'Manage Site Contact '], 'route' => 'settings.site_contacts', 'module' => 'settings.site_contacts', 'as' => 'settings.site_contacts.show', 'icon' => 'fa fa-address-book', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        $updateSiteContacts  =  Permission::create(['name' => 'update_site_contacts', 'display_name'    => ['ar'    =>  'تعديل بيانات الإتصال ', 'en'   =>  'Edit Site Contact '], 'route' => 'settings.site_contacts', 'module' => 'settings.site_contacts', 'as' => 'settings.site_contacts.edit', 'icon' => null, 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Site Socials
        $displaySiteSocails =  Permission::create(['name' => 'display_site_socials', 'display_name'     =>  ['ar'   =>  ' إدارة  حسابات التواصل  ',   'en'    =>  'Manage Site Socials'], 'route' => 'settings.site_socials', 'module' => 'settings.site_socials', 'as' => 'settings.site_socials.show', 'icon' => 'fas fa-rss', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        $updateSiteSocails  =  Permission::create(['name' => 'update_site_socials', 'display_name'      =>  ['ar'   =>  'تعديل حسابات التواصل ',   'en'    =>  'Edit Site Contact Infos'], 'route' => 'settings.site_socials', 'module' => 'settings.site_socials', 'as' => 'settings.site_socials.edit', 'icon' => null, 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Site SEO
        $displaySiteMetas =  Permission::create(['name' => 'display_site_meta', 'display_name'     =>  ['ar'   =>  'إدارة  SEO',   'en'    =>  'Manage Site SEO'], 'route' => 'settings.site_meta', 'module' => 'settings.site_meta', 'as' => 'settings.site_meta.show', 'icon' => 'fa fa-tag', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        $updateSiteMetas  =  Permission::create(['name' => 'update_site_meta', 'display_name'      =>  ['ar'   =>  'تعديل SEO',   'en'    =>  'Edit Site SEO'], 'route' => 'settings.site_meta', 'module' => 'settings.site_meta', 'as' => 'settings.site_meta.edit', 'icon' => null, 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Site payment methods
        // $displaySitePaymentMethods =  Permission::create(['name' => 'display_site_payment_methods', 'display_name'  =>  ['ar'   =>  'إدارة  طرق الدفع',   'en'    =>  'Manage Payment '], 'route' => 'settings.site_payment_methods', 'module' => 'settings.site_payment_methods', 'as' => 'settings.site_payment_methods.show', 'icon' => 'fas fa-dollar-sign', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        // $updateSitePaymentMethods  =  Permission::create(['name' => 'update_site_payment_methods', 'display_name'   =>  ['ar'   =>  'تعديل طرق الدفع',   'en'    =>  'Edit Site Payment '], 'route' => 'settings.site_payment_methods', 'module' => 'settings.site_payment_methods', 'as' => 'settings.site_payment_methods.edit', 'icon' => null, 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Site counters
        // $displaySiteCounters =  Permission::create(['name' => 'display_site_counters', 'display_name'   =>  ['ar'   =>  'إدارة  عدادات الموقع',   'en'    =>  'Manage Counters'], 'route' => 'settings.site_counters', 'module' => 'settings.site_counters', 'as' => 'settings.site_counters.show', 'icon' => 'fas fa-calculator', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        // $updateSiteCounters  =  Permission::create(['name' => 'update_site_counters', 'display_name'    =>  ['ar'   =>  'تعديل عدادات الموقع',   'en'    =>  'Edit Site Counters'], 'route' => 'settings.site_counters', 'module' => 'settings.site_counters', 'as' => 'settings.site_counters.edit', 'icon' => null, 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '0', 'appear' => '0']);


        // Account Settings
        $manageAccountSettings = Permission::create(['name' => 'manage_account_settings', 'display_name' => ['ar'   =>  'إدارة حسابات المشرفين',   'en'    =>  'Manage Supervisor Accounts'], 'route' => 'account_settings', 'module' => 'account_settings', 'as' => 'account_settings', 'icon' => 'fas fa-user', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '1', 'ordering' => '190',]);
        $manageAccountSettings->parent_show = $manageAccountSettings->id;
        $manageAccountSettings->save();
        $showAccountSettings    =  Permission::create(['name' => 'show_account_settings',  'display_name'       =>  ['ar'   =>  'إدارة حسابات المشرفين',   'en'    =>  'Supervisor Accounts'], 'route' => 'account_settings', 'module' => 'account_settings', 'as' => 'account_settings', 'icon' => 'fas fa-calculator', 'parent' => $manageAccountSettings->id, 'parent_original' => $manageAccountSettings->id, 'parent_show' => $manageAccountSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        $displayAccountSettings =  Permission::create(['name' => 'display_account_settings', 'display_name'     =>  ['ar'   =>  'عرض حسابات المشرفين ',   'en'    =>  'Dsiplay Supervisor Accounts'], 'route' => 'account_settings', 'module' => 'account_settings', 'as' => 'account_settings.show', 'icon' => null, 'parent' => $manageAccountSettings->id, 'parent_original' => $manageAccountSettings->id, 'parent_show' => $manageAccountSettings->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateAccountSettings  =  Permission::create(['name' => 'update_account_settings', 'display_name'      =>  ['ar'   =>  'تعديل حسابات المشرفين',   'en'    =>  'Edit Supervisor Accounts'], 'route' => 'account_settings', 'module' => 'account_settings', 'as' => 'update_account_settings', 'icon' => null, 'parent' => $manageAccountSettings->id, 'parent_original' => $manageAccountSettings->id, 'parent_show' => $manageAccountSettings->id, 'sidebar_link' => '0', 'appear' => '0']);

         // Assign all permissions to the admin role
         $permissions = Permission::all();
         $adminRole->attachPermissions($permissions);
    }
}
