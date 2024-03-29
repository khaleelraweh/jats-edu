<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
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


        //LecturerRole added in lecturer seeder 



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

        // Create lecturer added in lecturer seeder 


        //------------- 03- AttachRoles To  Users  ------------//
        $admin->attachRole($adminRole);
        $supervisor->attachRole($supervisorRole);
        $customer->attachRole($customerRole);
        // $lecturer->attachRole($lecturerRole);


        //------------- 04-  Create random customer and  AttachRole to customerRole  ------------//
        for ($i = 1; $i <= 20; $i++) {
            //Create random customer
            $random_customer = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'username' => $faker->unique()->userName,
                'email' => $faker->unique()->email,
                'email_verified_at' => now(),
                'mobile' => '0096777' . $faker->numberBetween(1000000, 9999999),
                'password' => bcrypt('123123123'),
                'user_image' => 'avator.svg',
                'status' => 1,
                'remember_token' => Str::random(10),
            ]);

            //Add customerRole to RandomCusomer
            $random_customer->attachRole($customerRole);
        } //end for

        //------------- 05- Permission  ------------//
        //manage main dashboard page
        $manageMain = Permission::create(['name' => 'main', 'display_name' => ['ar' =>  'الرئيسية', 'en'   =>  'Main'], 'route' => 'index', 'module' => 'index', 'as' => 'index', 'icon' => 'ri-dashboard-line', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        //web menus 
        $manageWebMenus = Permission::create(['name' => 'manage_web_menus', 'display_name' => ['ar' => 'إدارة القوائم', 'en' => 'Manage Menus'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.index', 'icon' => 'fa fa-list-ul', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
        $manageWebMenus->parent_show = $manageWebMenus->id;
        $manageWebMenus->save();
        $showWebMenus    =  Permission::create(['name' => 'show_web_menus',  'display_name' => ['ar'     => 'إدارة القائمة الرئيسية', 'en'  =>   'Main Menu'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createWebMenus  =  Permission::create(['name' => 'create_web_menus', 'display_name'  => ['ar'     => 'إضافة رابط', 'en'  =>  'Add Link'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.create', 'icon' => null, 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayWebMenus =  Permission::create(['name' => 'display_web_menus', 'display_name'  => ['ar'     => 'عرض رابط', 'en'  =>  'Display Link'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.show', 'icon' => null, 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateWebMenus  =  Permission::create(['name' => 'update_web_menus', 'display_name'  => ['ar'     => 'تعديل رابط', 'en'  =>  'Edit Link'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.edit', 'icon' => null, 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteWebMenus  =  Permission::create(['name' => 'delete_web_menus', 'display_name'  => ['ar'     => 'حذف رابط', 'en'  =>  'Delete Link'], 'route' => 'web_menus', 'module' => 'web_menus', 'as' => 'web_menus.destroy', 'icon' => null, 'parent' => $manageWebMenus->id, 'parent_original' => $manageWebMenus->id, 'parent_show' => $manageWebMenus->id, 'sidebar_link' => '0', 'appear' => '0']);

        //company menu
        $manageCompanyMenu = Permission::create(['name' => 'manage_company_menus', 'display_name' => ['ar'    =>  'إدارة قائمة الموسسة', 'en'   =>  'Company Menu'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageCompanyMenu->parent_show = $manageCompanyMenu->id;
        $manageCompanyMenu->save();
        $showCompanyMenu    =  Permission::create(['name' => 'show_company_menus',  'display_name' => ['ar'  =>  'إدارة قوائم الموسسة',   'en'    =>  'Manage Company Menu'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCompanyMenu  =  Permission::create(['name' => 'create_company_menus', 'display_name'  => ['ar'  =>  'إضافة قائمة',   'en'    =>  'Add menu Link'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.create', 'icon' => null, 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayCompanyMenu =  Permission::create(['name' => 'display_company_menus', 'display_name'  => ['ar'  =>  'عرض قائمة',   'en'    =>  'Display menu Link'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.show', 'icon' => null, 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCompanyMenu  =  Permission::create(['name' => 'update_company_menus', 'display_name'  => ['ar'  =>  'تعديل قائمة',   'en'    =>  'Edit menu Link'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.edit', 'icon' => null, 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCompanyMenu  =  Permission::create(['name' => 'delete_company_menus', 'display_name'  => ['ar'  =>  'حذف قائمة',   'en'    =>  'Delete menu Link'], 'route' => 'company_menus', 'module' => 'company_menus', 'as' => 'company_menus.destroy', 'icon' => null, 'parent' => $manageCompanyMenu->id, 'parent_original' => $manageCompanyMenu->id, 'parent_show' => $manageCompanyMenu->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Topics menu
        $manageTopicsMenus = Permission::create(['name' => 'manage_topics_menus', 'display_name' => ['ar'    =>  'إدارة قائمة المواضيع', 'en'   =>  'Topics Menu'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageTopicsMenus->parent_show = $manageTopicsMenus->id;
        $manageTopicsMenus->save();
        $showTopicsMenus    =  Permission::create(['name' => 'show_topics_menus',  'display_name' => ['ar'  =>  'إدارة قائمة المواضيع',   'en'    =>  'Topics Menu'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createTopicsMenus  =  Permission::create(['name' => 'create_topics_menus', 'display_name'  => ['ar'  =>  'إضافة رابط',   'en'    =>  'Add menu Link'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.create', 'icon' => null, 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayTopicsMenus =  Permission::create(['name' => 'display_topics_menus', 'display_name'  => ['ar'  =>  'عرض رابط',   'en'    =>  'Display menu Link'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.show', 'icon' => null, 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateTopicsMenus  =  Permission::create(['name' => 'update_topics_menus', 'display_name'  => ['ar'  =>  'تعديل رابط',   'en'    =>  'Edit menu Link'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.edit', 'icon' => null, 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteTopicsMenus  =  Permission::create(['name' => 'delete_topics_menus', 'display_name'  => ['ar'  =>  'حذف رابط',   'en'    =>  'Delete menu Link'], 'route' => 'topics_menus', 'module' => 'topics_menus', 'as' => 'topics_menus.destroy', 'icon' => null, 'parent' => $manageTopicsMenus->id, 'parent_original' => $manageTopicsMenus->id, 'parent_show' => $manageTopicsMenus->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Tracks menu
        $manageTracksMenus = Permission::create(['name' => 'manage_tracks_menus', 'display_name' => ['ar'    =>  'إدارة قائمة المسارات', 'en'   =>  'Tracks Menu'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageTracksMenus->parent_show = $manageTracksMenus->id;
        $manageTracksMenus->save();
        $showTracksMenus    =  Permission::create(['name' => 'show_tracks_menus',  'display_name' => ['ar'  =>  'إدارة قائمة المسارات',   'en'    =>  'Tracks Menu'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createTracksMenus  =  Permission::create(['name' => 'create_tracks_menus', 'display_name'  => ['ar'  =>  'إضافة رابط',   'en'    =>  'Add menu Link'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.create', 'icon' => null, 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayTracksMenus =  Permission::create(['name' => 'display_tracks_menus', 'display_name'  => ['ar'  =>  'عرض رابط',   'en'    =>  'Display menu Link'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.show', 'icon' => null, 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateTracksMenus  =  Permission::create(['name' => 'update_tracks_menus', 'display_name'  => ['ar'  =>  'تعديل رابط',   'en'    =>  'Edit menu Link'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.edit', 'icon' => null, 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteTracksMenus  =  Permission::create(['name' => 'delete_tracks_menus', 'display_name'  => ['ar'  =>  'حذف رابط',   'en'    =>  'Delete menu Link'], 'route' => 'tracks_menus', 'module' => 'tracks_menus', 'as' => 'tracks_menus.destroy', 'icon' => null, 'parent' => $manageTracksMenus->id, 'parent_original' => $manageTracksMenus->id, 'parent_show' => $manageTracksMenus->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Support menu
        $manageSupportMenus = Permission::create(['name' => 'manage_support_menus', 'display_name' => ['ar'    =>  'إدارة قائمة الدعم', 'en'   =>  'Support Menu'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
        $manageSupportMenus->parent_show = $manageSupportMenus->id;
        $manageSupportMenus->save();
        $showSupportMenus    =  Permission::create(['name' => 'show_support_menus',  'display_name' => ['ar'  =>  'إدارة قائمة الدعم',   'en'    =>  'Support Menu'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createSupportMenus  =  Permission::create(['name' => 'create_support_menus', 'display_name'  => ['ar'  =>  'إضافة رابط',   'en'    =>  'Add menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.create', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displaySupportMenus =  Permission::create(['name' => 'display_support_menus', 'display_name'  => ['ar'  =>  'عرض رابط',   'en'    =>  'Display menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.show', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateSupportMenus  =  Permission::create(['name' => 'update_support_menus', 'display_name'  => ['ar'  =>  'تعديل رابط',   'en'    =>  'Edit menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.edit', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteSupportMenus  =  Permission::create(['name' => 'delete_support_menus', 'display_name'  => ['ar'  =>  'حذف رابط',   'en'    =>  'Delete menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.destroy', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);

        //web menu helper
        $manageWebMenuHelps = Permission::create(['name' => 'manage_web_menu_helps', 'display_name' => ['ar'    =>  'إدارة قائمة المساعدة', 'en'   =>  'Helps Menu'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.index', 'icon' => 'fa fa-question', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '10',]);
        $manageWebMenuHelps->parent_show = $manageWebMenuHelps->id;
        $manageWebMenuHelps->save();
        $showWebMenuHelps    =  Permission::create(['name' => 'show_web_menu_helps',  'display_name' => ['ar'  =>  'إدارة قوائم المساعدة',   'en'    =>  'Helps Menu'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.index', 'icon' => 'fa fa-question', 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createWebMenuHelps  =  Permission::create(['name' => 'create_web_menu_helps', 'display_name'  => ['ar'  =>  'إضافة رابط',   'en'    =>  'Add Helps Link'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.create', 'icon' => null, 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayWebMenuHelps =  Permission::create(['name' => 'display_web_menu_helps', 'display_name'  => ['ar'  =>  'عرض رابط',   'en'    =>  'Display Helps Link'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.show', 'icon' => null, 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateWebMenuHelps  =  Permission::create(['name' => 'update_web_menu_helps', 'display_name'  => ['ar'  =>  'تعديل رابط',   'en'    =>  'Edit Helps Link'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.edit', 'icon' => null, 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteWebMenuHelps  =  Permission::create(['name' => 'delete_web_menu_helps', 'display_name'  => ['ar'  =>  'حذف رابط',   'en'    =>  'Delete Helps Link'], 'route' => 'web_menu_helps', 'module' => 'web_menu_helps', 'as' => 'web_menu_helps.destroy', 'icon' => null, 'parent' => $manageWebMenuHelps->id, 'parent_original' => $manageWebMenuHelps->id, 'parent_show' => $manageWebMenuHelps->id, 'sidebar_link' => '0', 'appear' => '0']);


        //main sliders
        $manageMainSliders = Permission::create(['name' => 'manage_main_sliders', 'display_name' => ['ar'    =>  'إدارة عارض الشرائح', 'en' =>  'Manage Slide Viewer'], 'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.index', 'icon' => 'fas fa-sliders-h', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '15',]);
        $manageMainSliders->parent_show = $manageMainSliders->id;
        $manageMainSliders->save();
        $showMainSliders    =  Permission::create(['name' => 'show_main_sliders', 'display_name'    =>  ['ar'    =>  ' عارض الشرائح الرئيسي',   'en'    =>  'Main Slide Viewer'], 'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.index', 'icon' => 'fas  fa-sliders-h', 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createMainSliders  =  Permission::create(['name' => 'create_main_sliders', 'display_name'    =>  ['ar'    =>  'إضافة شريحة جديد',   'en'    =>  'Add Slide'], 'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.create', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayMainSliders =  Permission::create(['name' => 'display_main_sliders', 'display_name'    =>  ['ar'    =>  'عرض الشريحة',   'en'    =>  'Display Main Slide'],  'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.show', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateMainSliders  =  Permission::create(['name' => 'update_main_sliders', 'display_name'    =>  ['ar'    =>  'تعديل الشريحة',   'en'    =>  'Edit Main Slide'],  'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.edit', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteMainSliders  =  Permission::create(['name' => 'delete_main_sliders', 'display_name'    =>  ['ar'    =>  'حذف الشريحة',   'en'    =>  'Delete Main Slide'],  'route' => 'main_sliders', 'module' => 'main_sliders', 'as' => 'main_sliders.destroy', 'icon' => null, 'parent' => $manageMainSliders->id, 'parent_original' => $manageMainSliders->id, 'parent_show' => $manageMainSliders->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Advertisor sliders
        $manageAdvertisorSliders = Permission::create(['name' => 'manage_advertisor_sliders', 'display_name' => ['ar'    =>  'عارض شرائح الإعلانات', 'en'   =>  'Adv Slide Viewer'], 'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.index', 'icon' => 'fas fa-bullhorn', 'parent' => $manageMainSliders->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '20',]);
        $manageAdvertisorSliders->parent_show = $manageAdvertisorSliders->id;
        $manageAdvertisorSliders->save();
        $showAdvertisorSliders    =  Permission::create(['name' => 'show_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'عارض شرائح الإعلانات',   'en'    =>  'Adv Slide Viewer'], 'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.index', 'icon' => 'fas fa-bullhorn', 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createAdvertisorSliders  =  Permission::create(['name' => 'create_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'إضافة شريحة جديد',   'en'    =>  'Add Adv Slide'], 'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.create', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayAdvertisorSliders =  Permission::create(['name' => 'display_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'عرض الشريحة',   'en'    =>  'Display Adv Slide'],  'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.show', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateAdvertisorSliders  =  Permission::create(['name' => 'update_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'تعديل الشريحة',   'en'    =>  'Edit Adv Slide'],  'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.edit', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteAdvertisorSliders  =  Permission::create(['name' => 'delete_advertisor_sliders', 'display_name'    =>  ['ar'   =>  'حذف الشريحة',   'en'    =>  'Delete Adv Slide'],  'route' => 'advertisor_sliders', 'module' => 'advertisor_sliders', 'as' => 'advertisor_sliders.destroy', 'icon' => null, 'parent' => $manageAdvertisorSliders->id, 'parent_original' => $manageAdvertisorSliders->id, 'parent_show' => $manageAdvertisorSliders->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Instructors
        $manageInstructors = Permission::create(['name' => 'manage_instructors', 'display_name' => ['ar'    =>  'إدارة المحاضرين', 'en' =>  'Manage Instructors'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.index', 'icon' => 'fas fa-sliders-h', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '25',]);
        $manageInstructors->parent_show = $manageInstructors->id;
        $manageInstructors->save();
        $showInstructors    =  Permission::create(['name' => 'show_instructors', 'display_name'    =>  ['ar'    =>  ' عرض المحاضرين',   'en'    =>  'Main Instructors'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.index', 'icon' => 'fas  fa-sliders-h', 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createInstructors  =  Permission::create(['name' => 'create_instructors', 'display_name'    =>  ['ar'    =>  'إضافة محاضر جديد',   'en'    =>  'Add Instructor'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.create', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayInstructors =  Permission::create(['name' => 'display_instructors', 'display_name'    =>  ['ar'    =>  'عرض محاضر',   'en'    =>  'Display Main Instructor'],  'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.show', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateInstructors  =  Permission::create(['name' => 'update_instructors', 'display_name'    =>  ['ar'    =>  'تعديل محاضر',   'en'    =>  'Edit Main Instructor'],  'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.edit', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteInstructors  =  Permission::create(['name' => 'delete_instructors', 'display_name'    =>  ['ar'    =>  'حذف محاضر',   'en'    =>  'Delete Main Instructor'],  'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.destroy', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Procuct Categories
        $manageProductCategories = Permission::create(['name' => 'manage_product_categories', 'display_name' => ['ar'   =>  'إدارة تصنيف المنتجات',  'en'    =>  'Manage Product Categories'], 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '25',]);
        $manageProductCategories->parent_show = $manageProductCategories->id;
        $manageProductCategories->save();
        $showProductCategories    =  Permission::create(['name' => 'show_product_categories',  'display_name' =>    ['ar'   =>  'تصنيف المنتجات',   'en'    =>  'Product Categories'], 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createProductCategories  =  Permission::create(['name' => 'create_product_categories', 'display_name'  =>    ['ar'   =>  'إضافة تصنيف',   'en'    =>  'Add Product Category'], 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.create', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayProductCategories =  Permission::create(['name' => 'display_product_categories', 'display_name'  =>    ['ar'   =>  'عرض تصنيف',   'en'    =>  'Display Product Category '], 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.show', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateProductCategories  =  Permission::create(['name' => 'update_product_categories', 'display_name'  =>    ['ar'   =>  'تعديل تصنيف',   'en'    =>  'Edit Product Category'], 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.edit', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteProductCategories  =  Permission::create(['name' => 'delete_product_categories', 'display_name'  =>    ['ar'   =>  'حذف تصنيف',   'en'    =>  'Delete Product Category'], 'route' => 'product_categories', 'module' => 'product_categories', 'as' => 'product_categories.destroy', 'icon' => null, 'parent' => $manageProductCategories->id, 'parent_original' => $manageProductCategories->id, 'parent_show' => $manageProductCategories->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Products 
        $manageProducts = Permission::create(['name' => 'manage_products', 'display_name' => ['ar'  =>  'المنتجات', 'en'    =>  'Products'], 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageProductCategories->id, 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '30',]);
        $manageProducts->parent_show = $manageProducts->id;
        $manageProducts->save();
        $showProducts    =  Permission::create(['name' => 'show_products',  'display_name' =>   ['ar'   =>  'المنتجات',   'en'    =>  'Products'], 'route' => 'products', 'module' => 'products', 'as' => 'products.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createProducts  =  Permission::create(['name' => 'create_products', 'display_name'  =>   ['ar'   =>  'إضافة منتج',   'en'    =>  'Add product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.create', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayProducts =  Permission::create(['name' => 'display_products', 'display_name'  =>   ['ar'   =>  'عرض منتج',   'en'    =>  'Display Product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.show', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateProducts  =  Permission::create(['name' => 'update_products', 'display_name'  =>   ['ar'   =>  'تعديل منتج',   'en'    =>  'Edit Product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.edit', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteProducts  =  Permission::create(['name' => 'delete_products', 'display_name'  =>   ['ar'   =>  'حذف منتج',   'en'    =>  'Delete Product'], 'route' => 'products', 'module' => 'products', 'as' => 'products.destroy', 'icon' => null, 'parent' => $manageProducts->id, 'parent_original' => $manageProducts->id, 'parent_show' => $manageProducts->id, 'sidebar_link' => '0', 'appear' => '0']);

        //manage card categories
        $manageCardCategories = Permission::create(['name' => 'manage_card_categories', 'display_name' => ['ar'    =>  'إدارة البطائق',   'en'    =>  'Card Category'], 'route' => 'card_categories', 'module' => 'card_categories', 'as' => 'card_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '35',]);
        $manageCardCategories->parent_show = $manageCardCategories->id;
        $manageCardCategories->save();
        $showcard_categories    =  Permission::create(['name' => 'show_card_categories', 'display_name'  =>    ['ar'   =>  'تصنيف البطائق',   'en'    =>  'Card Categories'],   'route' => 'card_categories', 'module' => 'card_categories', 'as' => 'card_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageCardCategories->id, 'parent_original' => $manageCardCategories->id, 'parent_show' => $manageCardCategories->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createcard_categories  =  Permission::create(['name' => 'create_card_categories', 'display_name'  =>    ['ar'   =>  'إضافة تصنيف بطاقة',   'en'    =>  'Add Card Category'],    'route' => 'card_categories', 'module' => 'card_categories', 'as' => 'card_categories.create', 'icon' => null, 'parent' => $manageCardCategories->id, 'parent_original' => $manageCardCategories->id, 'parent_show' => $manageCardCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displaycard_categories =  Permission::create(['name' => 'display_card_categories', 'display_name'  =>    ['ar'   =>  ' عرض تصنيف بطاقة',   'en'    =>  'Display Card Category'],    'route' => 'card_categories', 'module' => 'card_categories', 'as' => 'card_categories.show', 'icon' => null, 'parent' => $manageCardCategories->id, 'parent_original' => $manageCardCategories->id, 'parent_show' => $manageCardCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatecard_categories  =  Permission::create(['name' => 'update_card_categories', 'display_name'  =>    ['ar'   =>  'تعديل تصنيف بطاقة',   'en'    =>  'Edit Card Category'],    'route' => 'card_categories', 'module' => 'card_categories', 'as' => 'card_categories.edit', 'icon' => null, 'parent' => $manageCardCategories->id, 'parent_original' => $manageCardCategories->id, 'parent_show' => $manageCardCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletecard_categories  =  Permission::create(['name' => 'delete_card_categories', 'display_name'  =>    ['ar'   =>  'حذف تصنيف بطاقة',   'en'    =>  'Delete Card Category'],    'route' => 'card_categories', 'module' => 'card_categories', 'as' => 'card_categories.destroy', 'icon' => null, 'parent' => $manageCardCategories->id, 'parent_original' => $manageCardCategories->id, 'parent_show' => $manageCardCategories->id, 'sidebar_link' => '0', 'appear' => '0']);

        //manage Course categories
        $manageCourseCategories = Permission::create(['name' => 'manage_course_categories', 'display_name' => ['ar'    =>  'إدارة الدورات',   'en'    =>  'Manage Courses'], 'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.index', 'icon' => 'fas fa-align-justify', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '35',]);
        $manageCourseCategories->parent_show = $manageCourseCategories->id;
        $manageCourseCategories->save();
        $showCourseCategories    =  Permission::create(['name' => 'show_course_categories', 'display_name'       =>    ['ar'   =>  'تصنيف الدورات',   'en'    =>  ' Categories'],   'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.index', 'icon' => 'fas fa-align-justify', 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCourseCategories  =  Permission::create(['name' => 'create_course_categories', 'display_name'     =>    ['ar'   =>  'إضافة تصنيف الدورة',   'en'    =>  'Add Course Category'],    'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.create', 'icon' => null, 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayCourseCategories =  Permission::create(['name' => 'display_course_categories', 'display_name'    =>    ['ar'   =>  ' عرض تصنيف الدورة',   'en'    =>  'Display Course Category'],    'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.show', 'icon' => null, 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCourseCategories  =  Permission::create(['name' => 'update_course_categories', 'display_name'     =>    ['ar'   =>  'تعديل تصنيف الدورة',   'en'    =>  'Edit Course Category'],    'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.edit', 'icon' => null, 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCourseCategories  =  Permission::create(['name' => 'delete_course_categories', 'display_name'     =>    ['ar'   =>  'حذف تصنيف الدورة',   'en'    =>  'Delete Course Category'],    'route' => 'course_categories', 'module' => 'course_categories', 'as' => 'course_categories.destroy', 'icon' => null, 'parent' => $manageCourseCategories->id, 'parent_original' => $manageCourseCategories->id, 'parent_show' => $manageCourseCategories->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Manage cards 
        $manageCards = Permission::create(['name' => 'manage_cards', 'display_name' => ['ar'    =>  'الباقات', 'en'    =>  'Cards'], 'route' => 'cards', 'module' => 'cards', 'as' => 'cards.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageCardCategories->id, 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '40',]);
        $manageCards->parent_show = $manageCards->id;
        $manageCards->save();
        $showCards   =  Permission::create(['name' => 'show_cards',   'display_name'    =>  ['ar'   =>  'عرض الباقات',   'en'       =>  'Cards'],   'route'     => 'cards', 'module'   => 'cards', 'as' =>  'cards.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageCards->id, 'parent_original' => $manageCards->id, 'parent_show' => $manageCards->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCards =  Permission::create(['name' => 'create_cards',   'display_name'    =>  ['ar'   =>  'إضافة باقة جديدة',   'en'    =>  'Add new Card'],   'route'     => 'cards', 'module'  => 'cards', 'as' =>   'cards.create', 'icon' => null, 'parent' => $manageCards->id, 'parent_original' => $manageCards->id, 'parent_show' => $manageCards->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCards =  Permission::create(['name' => 'display_cards',   'display_name'    =>  ['ar'   =>  'عرض باقة',   'en'          =>  'Display Card'],   'route'     => 'cards',  'module'  => 'cards', 'as' =>  'cards.show', 'icon' => null, 'parent' => $manageCards->id, 'parent_original' => $manageCards->id, 'parent_show' => $manageCards->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCards =  Permission::create(['name' => 'update_cards',   'display_name'    =>  ['ar'   =>  'تعديل بطاقة',   'en'       =>  'Edit Card'],   'route'     => 'cards', 'module'   => 'cards', 'as' =>  'cards.edit', 'icon' => null, 'parent' => $manageCards->id, 'parent_original' => $manageCards->id, 'parent_show' => $manageCards->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCards =  Permission::create(['name' => 'delete_cards',   'display_name'    =>  ['ar'   =>  'حذف بطاقة',   'en'         =>  'Delete Card'],   'route'     => 'cards', 'module'   => 'cards', 'as' =>  'cards.destroy', 'icon' => null, 'parent' => $manageCards->id, 'parent_original' => $manageCards->id, 'parent_show' => $manageCards->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Manage courses 
        $manageCourses = Permission::create(['name' => 'manage_courses', 'display_name' => ['ar'    =>  'الدورات', 'en'    =>  'Courses'], 'route' => 'courses', 'module' => 'courses', 'as' => 'courses.index', 'icon' => 'fas fa-book-open', 'parent' => $manageCourseCategories->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '40',]);
        $manageCourses->parent_show = $manageCourses->id;
        $manageCourses->save();
        $showCourses   =  Permission::create(['name' => 'show_courses',   'display_name'    =>  ['ar'   =>  'عرض الدورات',   'en'       =>  'Courses'],   'route'     => 'courses', 'module'   => 'courses', 'as' =>  'courses.index', 'icon' => 'fas fa-align-justify', 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCourses =  Permission::create(['name' => 'create_courses',   'display_name'    =>  ['ar'   =>  'إضافة دورة جديدة',   'en'    =>  'Add new Course'],   'route'     => 'courses', 'module'  => 'courses', 'as' =>   'courses.create', 'icon' => null, 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCourses =  Permission::create(['name' => 'display_courses',   'display_name'    =>  ['ar'   =>  'عرض دورة',   'en'          =>  'Display Course'],   'route'     => 'courses',  'module'  => 'courses', 'as' =>  'courses.show', 'icon' => null, 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCourses =  Permission::create(['name' => 'update_courses',   'display_name'    =>  ['ar'   =>  'تعديل دورة',   'en'       =>  'Edit Course'],   'route'     => 'courses', 'module'   => 'courses', 'as' =>  'courses.edit', 'icon' => null, 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCourses =  Permission::create(['name' => 'delete_courses',   'display_name'    =>  ['ar'   =>  'حذف دورة',   'en'         =>  'Delete Course'],   'route'     => 'courses', 'module'   => 'courses', 'as' =>  'courses.destroy', 'icon' => null, 'parent' => $manageCourses->id, 'parent_original' => $manageCourses->id, 'parent_show' => $manageCourses->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Customers
        $manageCustomers = Permission::create(['name' => 'manage_customers', 'display_name' => ['ar'    =>  'إدارة المستخدمين',  'en' =>  'Manage Users'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user-cog', 'parent' => '0', 'parent_original' => '0',  'sidebar_link' => '1', 'appear' => '1', 'ordering' => '45',]);
        $manageCustomers->parent_show = $manageCustomers->id;
        $manageCustomers->save();
        $showCustomers   =  Permission::create(['name'  => 'show_customers', 'display_name'    => ['ar'   =>     'العملاء',   'en'    =>  'Customers'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.index', 'icon' => 'fas fa-user-graduate', 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCustomers =  Permission::create(['name'  => 'create_customers', 'display_name'    => ['ar'   =>      'إضافة عميل',   'en'    =>  'Add New Customer'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.create', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCustomers =  Permission::create(['name' => 'display_customers', 'display_name'     => ['ar'   =>      'عرض عميل',   'en'    =>  'Dsiplay Customer'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.show', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCustomers  =  Permission::create(['name' => 'update_customers', 'display_name'     => ['ar'   =>      'تعديل عميل',   'en'    =>  'Edit Customer'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.edit', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCustomers =  Permission::create(['name'  => 'delete_customers', 'display_name'    => ['ar'   =>      'حذف عميل',   'en'    =>  'Delete Customer'], 'route' => 'customers', 'module' => 'customers', 'as' => 'customers.destroy', 'icon' => null, 'parent' => $manageCustomers->id, 'parent_original' => $manageCustomers->id, 'parent_show' => $manageCustomers->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Supervisor // we can hide suppervisor not to be in sidebar linke by  making in manage_supervisors 'sidebar_link' => '0'
        $manageSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name' => ['ar'    =>  'المشرفين',    'en'    =>  'Supervisors'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-user-tie', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
        $manageSupervisors->parent_show = $manageSupervisors->id;
        $manageSupervisors->save();
        $showSupervisors   =  Permission::create(['name' => 'show_supervisors', 'display_name'    =>  ['ar'   =>  'المشرفين',   'en'    =>  'Supervisors'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.index', 'icon' => 'fas fa-user-tie', 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createSupervisors =  Permission::create(['name' => 'create_supervisors', 'display_name'    =>  ['ar'   =>  'إضافة مشرف جديد',   'en'    =>  'Add Supervisor'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.create', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displaySupervisors =  Permission::create(['name' => 'display_supervisors', 'display_name'    =>  ['ar'   =>  'عرض مشرف',   'en'    =>  'Dsiplay Supervisor'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.show', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateSupervisors  =  Permission::create(['name' => 'update_supervisors', 'display_name'    =>  ['ar'   =>  'تعديل مشرف',   'en'    =>  'Edit Supervisor'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.edit', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteSupervisors =  Permission::create(['name' => 'delete_supervisors', 'display_name'    =>  ['ar'   =>  'حذف مشرف',   'en'    =>  'Delete Supervisor'], 'route' => 'supervisors', 'module' => 'supervisors', 'as' => 'supervisors.destroy', 'icon' => null, 'parent' => $manageSupervisors->id, 'parent_original' => $manageSupervisors->id, 'parent_show' => $manageSupervisors->id, 'sidebar_link' => '0', 'appear' => '0']);

        //lecturers
        $manageLecturers = Permission::create(['name' => 'manage_lecturers', 'display_name' => ['ar'    =>  'المحاضرين',    'en'    =>  'lecturers'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.index', 'icon' => 'fas fa-chalkboard-teacher', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '55',]);
        $manageLecturers->parent_show = $manageLecturers->id;
        $manageLecturers->save();
        $showlecturers   =  Permission::create(['name' => 'show_lecturers', 'display_name'    =>  ['ar'   =>  'المحاضرين',   'en'    =>  'lecturers'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.index', 'icon' => 'fas fa-chalkboard-teacher', 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createlecturers =  Permission::create(['name' => 'create_lecturers', 'display_name'    =>  ['ar'   =>  'إضافة محاضر جديد',   'en'    =>  'Add lecturer'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.create', 'icon' => null, 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displaylecturers =  Permission::create(['name' => 'display_lecturers', 'display_name'    =>  ['ar'   =>  'عرض محاضر',   'en'    =>  'Dsiplay lecturer'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.show', 'icon' => null, 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatelecturers  =  Permission::create(['name' => 'update_lecturers', 'display_name'    =>  ['ar'   =>  'تعديل محاضر',   'en'    =>  'Edit lecturer'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.edit', 'icon' => null, 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletelecturers =  Permission::create(['name' => 'delete_lecturers', 'display_name'    =>  ['ar'   =>  'حذف محاضر',   'en'    =>  'Delete lecturer'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.destroy', 'icon' => null, 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '0', 'appear' => '0']);

        //specialization
        $manageSpecializations = Permission::create(['name' => 'manage_specializations', 'display_name' => ['ar'    =>  'التخصصات',    'en'    =>  'specializations'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.index', 'icon' => 'fas fa-file-signature', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '55',]);
        $manageSpecializations->parent_show = $manageSpecializations->id;
        $manageSpecializations->save();
        $showSpecializations   =  Permission::create(['name' => 'show_specializations', 'display_name'    =>  ['ar'   =>  'التخصصات',   'en'    =>  'specializations'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.index', 'icon' => 'fas fa-file-signature', 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createSpecializations =  Permission::create(['name' => 'create_specializations', 'display_name'    =>  ['ar'   =>  'إضافة تخصص جديد',   'en'    =>  'Add specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.create', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displaySpecializations =  Permission::create(['name' => 'display_specializations', 'display_name'    =>  ['ar'   =>  'عرض تخصص',   'en'    =>  'Dsiplay specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.show', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateSpecializations  =  Permission::create(['name' => 'update_specializations', 'display_name'    =>  ['ar'   =>  'تعديل تخصص',   'en'    =>  'Edit specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.edit', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteSpecializations =  Permission::create(['name' => 'delete_specializations', 'display_name'    =>  ['ar'   =>  'حذف تخصص',   'en'    =>  'Delete specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.destroy', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '0', 'appear' => '0']);

        //userAddresses
        $manageCustomerAddresses = Permission::create(['name' => 'manage_customer_addresses', 'display_name' => ['ar'   => 'إدارة عناوين العملاء ', 'en'   =>  ' Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '60',]);
        $manageCustomerAddresses->parent_show = $manageCustomerAddresses->id;
        $manageCustomerAddresses->save();
        $showCustomerAddresses   =  Permission::create(['name'  => 'show_customer_addresses', 'display_name'    =>    ['ar'   =>  'عناوين العملاء',   'en'    =>  'Customer Addresses'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCustomerAddresses =  Permission::create(['name'  => 'create_customer_addresses', 'display_name'    =>    ['ar'   =>  'إنشاء عنوان جديد',   'en'    =>  'Add Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.create', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCustomerAddresses =  Permission::create(['name' => 'display_customer_addresses', 'display_name'     =>    ['ar'   =>  'عرض عنوان',   'en'    =>  'Display Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.show', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCustomerAddresses  =  Permission::create(['name' => 'update_customer_addresses', 'display_name'     =>    ['ar'   =>  'تعديل عنوان',   'en'    =>  'Edit Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.edit', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCustomerAddresses =  Permission::create(['name'  => 'delete_customer_addresses', 'display_name'    =>    ['ar'   =>  'حذف عنوان',   'en'    =>  'Delete Customer Address'], 'route' => 'customer_addresses', 'module' => 'customer_addresses', 'as' => 'customer_addresses.destroy', 'icon' => null, 'parent' => $manageCustomerAddresses->id, 'parent_original' => $manageCustomerAddresses->id, 'parent_show' => $manageCustomerAddresses->id, 'sidebar_link' => '0', 'appear' => '0']);




        //course Reviews
        $manageCourseReviews = Permission::create(['name' => 'manage_course_reviews', 'display_name' => ['ar' =>  'إدارة التعليقات',  'en'    =>  'Manage Comments'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '65',]);
        $manageCourseReviews->parent_show = $manageCourseReviews->id;
        $manageCourseReviews->save();
        $showCourseReviews   =  Permission::create(['name' => 'show_course_reviews',  'display_name'      =>  ['ar'   =>  'التعليقات',   'en'    =>  'Comments'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.index', 'icon' => 'fas fa-comment', 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCourseReviews =  Permission::create(['name' => 'create_course_reviews', 'display_name'     =>  ['ar'   =>  'إضافة تعليق',   'en'    =>  'Create Comment'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.create', 'icon' => null, 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCourseReviews =  Permission::create(['name' => 'display_course_reviews', 'display_name'   =>  ['ar'   =>  'عرض تعليق',   'en'    =>  'Display Comment'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.show', 'icon' => null, 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCourseReviews  =  Permission::create(['name' => 'update_course_reviews', 'display_name'    =>  ['ar'   =>  'تعديل تعليق',   'en'    =>  'Edit Comment'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.edit', 'icon' => null, 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCourseReviews =  Permission::create(['name' => 'delete_course_reviews', 'display_name'     =>  ['ar'   =>  'حذف تعليق',   'en'    =>  'Delete Comment'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.destroy', 'icon' => null, 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '0', 'appear' => '0']);




        //Product Tags
        $manageTags = Permission::create(['name' => 'manage_tags', 'display_name' => ['ar'  =>  'إدارة الكلمات المفتاحية',  'en'    =>  'Manage Tags'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '70',]);
        $manageTags->parent_show = $manageTags->id;
        $manageTags->save();
        $showTags    =  Permission::create(['name' => 'show_tags',  'display_name' =>   ['ar'   =>  ' الكلمات المفتاحية',   'en'        =>  'Tags'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.index', 'icon' => 'fas fa-tags', 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createTags  =  Permission::create(['name' => 'create_tags', 'display_name'  =>   ['ar'   =>  'إضافة كلمة مفتاحية',   'en'       =>  'Add New Tag'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.create', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayTags =  Permission::create(['name' => 'display_tags', 'display_name'  =>   ['ar'   =>  'استعراض كلمة مفتاحية',   'en'      =>  'Display Tag'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.show', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateTags  =  Permission::create(['name' => 'update_tags', 'display_name'  =>   ['ar'   =>  'تعديل كلمة مفتاحية',   'en'        =>  'Update Tag'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.edit', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteTags  =  Permission::create(['name' => 'delete_tags', 'display_name'  =>   ['ar'   =>  'حذف لكمة مفتاحية',   'en'          =>  'Delete Tag'], 'route' => 'tags', 'module' => 'tags', 'as' => 'tags.destroy', 'icon' => null, 'parent' => $manageTags->id, 'parent_original' => $manageTags->id, 'parent_show' => $manageTags->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Coupons
        $manageCoupons = Permission::create(['name' => 'manage_coupons', 'display_name' => ['ar'    =>  'إدارة كوبونات الخصم', 'en' =>  'Manage Coupons'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.index', 'icon' => 'fas fa-percent', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '75',]);
        $manageCoupons->parent_show = $manageCoupons->id;
        $manageCoupons->save();
        $showProductCoupons    =  Permission::create(['name' => 'show_coupons',  'display_name' =>  ['ar'   =>  'كوبونات الخصم',   'en'    =>  'Coupons'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.index', 'icon' => 'fas fa-percent', 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createProductCoupons  =  Permission::create(['name' => 'create_coupons', 'display_name'  =>  ['ar'   =>  'إنشاء كوبون ',   'en'    =>  'Add New Coupon'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.create', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayProductCoupons =  Permission::create(['name' => 'display_coupons', 'display_name'  =>  ['ar'   =>  'عرض كوبون',   'en'    =>  'Display Coupon'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.show', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateProductCoupons  =  Permission::create(['name' => 'update_coupons', 'display_name'  =>  ['ar'   =>  'تعديل كوبون',   'en'    =>  'Edit Coupon'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.edit', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteProductCoupons  =  Permission::create(['name' => 'delete_coupons', 'display_name'  =>  ['ar'   =>  'حذف كوبون',   'en'    =>  'Delete Coupon'], 'route' => 'coupons', 'module' => 'coupons', 'as' => 'coupons.destroy', 'icon' => null, 'parent' => $manageCoupons->id, 'parent_original' => $manageCoupons->id, 'parent_show' => $manageCoupons->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Countries
        $manageCountries = Permission::create(['name' => 'manage_countries', 'display_name' => ['ar'  =>  'إدارة البلدان',   'en'    =>  'Manage Countries'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '80',]);
        $manageCountries->parent_show = $manageCountries->id;
        $manageCountries->save();
        $showCountries   =  Permission::create(['name'     => 'show_countries', 'display_name'  => ['ar'   =>  'الدول',   'en'    =>  'Countries'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.index', 'icon' => 'fas fa-globe', 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCountries =  Permission::create(['name'     => 'create_countries', 'display_name'  => ['ar'   =>  'إضافة دولة',   'en'    =>  'Add Country'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.create', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCountries =  Permission::create(['name'     => 'display_countries', 'display_name'  => ['ar'   =>  'عرض بيانات الدولة',   'en'    =>  'Display Country'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.show', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCountries  =  Permission::create(['name'     => 'update_countries', 'display_name'  => ['ar'   =>  'تعديل بيانات الدولة',   'en'    =>  'Edit Country'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.edit', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCountries =  Permission::create(['name'     => 'delete_countries', 'display_name'  => ['ar'   =>  'حذف الدولة',   'en'    =>  'Delete Country'], 'route' => 'countries', 'module' => 'countries', 'as' => 'countries.destroy', 'icon' => null, 'parent' => $manageCountries->id, 'parent_original' => $manageCountries->id,  'parent_show' => $manageCountries->id, 'sidebar_link' => '0', 'appear' => '0']);

        //States
        $manageStates = Permission::create(['name' => 'manage_states', 'display_name' => ['ar' =>   'المحافظات',    'en'    =>  'States'], 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker-alt', 'parent' =>  $manageCountries->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '85',]);
        $manageStates->parent_show = $manageStates->id;
        $manageStates->save();
        $showStates     =  Permission::create(['name' => 'show_states', 'display_name'    => ['ar'  =>  'المحافظات',    'en'    =>  'States'], 'route' => 'states', 'module' => 'states', 'as' => 'states.index', 'icon' => 'fas fa-map-marker-alt', 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createStates   =  Permission::create(['name' => 'create_states', 'display_name'        =>  ['ar'   =>  'إضافة محافظة',   'en'    =>  'Create State'], 'route' => 'states', 'module' => 'states', 'as' => 'states.create', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayStates  =  Permission::create(['name' => 'display_states', 'display_name'       =>  ['ar'   =>  'عرض محافظة',   'en'    =>  'Display State'], 'route' => 'states', 'module' => 'states', 'as' => 'states.show', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateStates   =  Permission::create(['name' => 'update_states', 'display_name'        =>  ['ar'   =>  'تعديل محافظة',   'en'    =>  'Edit State'], 'route' => 'states', 'module' => 'states', 'as' => 'states.edit', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteStates   =  Permission::create(['name' => 'delete_states', 'display_name'        =>  ['ar'   =>  'حذف المحافظة',   'en'    =>  'Delete State'], 'route' => 'states', 'module' => 'states', 'as' => 'states.destroy', 'icon' => null, 'parent' => $manageStates->id, 'parent_original' => $manageStates->id, 'parent_show' => $manageStates->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Cities
        $manageCities = Permission::create(['name' => 'manage_cities', 'display_name' =>    ['ar'   =>  'المدن',   'en'    =>  'Cities'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' =>  $manageCountries->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '85',]);
        $manageCities->parent_show = $manageCities->id;
        $manageCities->save();
        $showCities     =  Permission::create(['name' => 'show_cities', 'display_name'          =>  ['ar'   =>  'المدن',           'en' =>  'Cities'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.index', 'icon' => 'fas fa-university', 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCities   =  Permission::create(['name' => 'create_cities', 'display_name'        =>  ['ar'   =>  'إضافة مدينة',     'en' =>  'Create City'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.create', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCities  =  Permission::create(['name' => 'display_cities', 'display_name'       =>  ['ar'   =>  'عرض مدينة',       'en' =>  'Display City'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.show', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCities   =  Permission::create(['name' => 'update_cities', 'display_name'        =>  ['ar'   =>  'تعديل المدينة',   'en' =>  'Edit City'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.edit', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCities   =  Permission::create(['name' => 'delete_cities', 'display_name'        =>  ['ar'   =>  'حذف المدينة',     'en' =>  'Delete City'], 'route' => 'cities', 'module' => 'cities', 'as' => 'cities.destroy', 'icon' => null, 'parent' => $manageCities->id, 'parent_original' => $manageCities->id, 'parent_show' => $manageCities->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Shipping Companies
        $manageShippingCompanies = Permission::create(['name' => 'manage_shipping_companies', 'display_name' => ['ar'   =>  'إدارة شركات الشحن',    'en'    =>  'Shipping Company'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '1', 'ordering' => '85',]);
        $manageShippingCompanies->parent_show = $manageShippingCompanies->id;
        $manageShippingCompanies->save();
        $showShippingCompanies   =  Permission::create(['name'  => 'show_shipping_companies', 'display_name'        =>  ['ar'   =>  'شركات الشحن',   'en'    =>  'Shipping Company'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.index', 'icon' => 'fas fa-map-marked-alt', 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createShippingCompanies =  Permission::create(['name'  => 'create_shipping_companies', 'display_name'      =>  ['ar'   =>  'إضافة شركة شحن',   'en'    =>  'Create Shipping Compnay'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.create', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayShippingCompanies =  Permission::create(['name'  => 'display_shipping_companies', 'display_name'    =>  ['ar'   =>  'عرض شركة الشحن',   'en'    =>  'Display Shipping Compnay'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.show', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateShippingCompanies =  Permission::create(['name'  => 'update_shipping_companies', 'display_name'      =>  ['ar'   =>  'تعديل شركة الشحن',   'en'    =>  'Edit Shipping Compnay'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.edit', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteShippingCompanies =  Permission::create(['name'  => 'delete_shipping_companies', 'display_name'      =>  ['ar'   =>  'حذف شركة الشحن',   'en'    =>  'Delete Shipping Compnay'], 'route' => 'shipping_companies', 'module' => 'shipping_companies', 'as' => 'shipping_companies.destroy', 'icon' => null, 'parent' => $manageShippingCompanies->id, 'parent_original' => $manageShippingCompanies->id, 'parent_show' => $manageShippingCompanies->id, 'sidebar_link' => '0', 'appear' => '0']);




        //Payment Methods
        $managePaymentMethods = Permission::create(['name' => 'manage_payment_methods', 'display_name' => ['ar' =>  'بوابات الدفع',    'en'    =>  'Payment Gateways'], 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.index', 'icon' => 'fas fa-dollar-sign', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '1', 'ordering' => '95',]);
        $managePaymentMethods->parent_show = $managePaymentMethods->id;
        $managePaymentMethods->save();
        $showPaymentMethods   =  Permission::create(['name'  => 'show_payment_methods', 'display_name'          =>  ['ar'   =>  'بوابات الدفع',   'en'    =>  'Payment Gateways'], 'route' => 'payment_methods', 'module' => 'payment_methods', 'as' => 'payment_methods.index', 'icon' => 'fas fa-dollar-sign', 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPaymentMethods =  Permission::create(['name'  => 'create_payment_methods', 'display_name'        =>  ['ar'   =>  'إضافة بوابة دفع',   'en'    =>  'Create Payment Gateway'], 'route' => 'payment_methods/create', 'module' => 'payment_methods', 'as' => 'payment_methods.create', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayPaymentMethods =  Permission::create(['name'  => 'display_payment_methods', 'display_name'      =>  ['ar'   =>  'عرض بوابة دفع',   'en'    =>  'Display Payment Gateway'], 'route' => 'payment_methods/{payment_methods}', 'module' => 'payment_methods', 'as' => 'payment_methods.show', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePaymentMethods =  Permission::create(['name'  => 'update_payment_methods', 'display_name'        =>  ['ar'   =>  'تعديل  بوابة الدفع',   'en'    =>  'Edit Payment Gateway'], 'route' => 'payment_methods/{payment_methods}/edit', 'module' => 'payment_methods', 'as' => 'payment_methods.edit', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePaymentMethods =  Permission::create(['name'  => 'delete_payment_methods', 'display_name'        =>  ['ar'   =>  'حذف بوابة الدفع',   'en'    =>  'Delete Payment Gateway'], 'route' => 'payment_methods/{payment_methods}', 'module' => 'payment_methods', 'as' => 'payment_methods.destroy', 'icon' => null, 'parent' => $managePaymentMethods->id, 'parent_original' => $managePaymentMethods->id, 'parent_show' => $managePaymentMethods->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Customer Orders
        $manageOrders = Permission::create(['name' => 'manage_orders', 'display_name' => ['ar'  =>  'إدارة الطلبات',    'en'    =>  'Manage Orders'], 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.index', 'icon' => 'fas fa-shopping-basket', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '100',]);
        $manageOrders->parent_show = $manageOrders->id;
        $manageOrders->save();
        $showOrders   =  Permission::create(['name'  => 'show_orders', 'display_name'       =>  ['ar'   =>  'الطلبات',   'en'    =>  'Orders'], 'route' => 'orders', 'module' => 'orders', 'as' => 'orders.index', 'icon' => 'fas fa-shopping-basket', 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createOrders =  Permission::create(['name'  => 'create_orders', 'display_name'     =>  ['ar'   =>  'إنشاء طلب ',   'en'    =>  'Create Order'], 'route' => 'orders/create', 'module' => 'orders', 'as' => 'orders.create', 'icon' => null, 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayOrders =  Permission::create(['name' => 'display_orders', 'display_name'    =>  ['ar'   =>  'عرض الطلب',   'en'    =>  'Display Order'], 'route' => 'orders/{orders}', 'module' => 'orders', 'as' => 'orders.show', 'icon' => null, 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateOrders  =  Permission::create(['name' => 'update_orders', 'display_name'     =>  ['ar'   =>  'تعديل الطلب',   'en'    =>  'Edit Order'], 'route' => 'orders/{orders}/edit', 'module' => 'orders', 'as' => 'orders.edit', 'icon' => null, 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteOrders =  Permission::create(['name'  => 'delete_orders', 'display_name'     =>  ['ar'   =>  'حذف الطلب',   'en'    =>  'Delete Order'], 'route' => 'orders/{orders}', 'module' => 'orders', 'as' => 'orders.destroy', 'icon' => null, 'parent' => $manageOrders->id, 'parent_original' => $manageOrders->id, 'parent_show' => $manageOrders->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Common Questions
        $manageCommonQuestions = Permission::create(['name' => 'manage_common_questions', 'display_name' => ['ar'   =>  'إدارة الاسئلة الشائعة',   'en'    =>  'Asked Questions'], 'route' => 'common_questions', 'module' => 'common_questions', 'as' => 'common_questions.index', 'icon' => 'fas fa-question', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '100',]);
        $manageCommonQuestions->parent_show = $manageCommonQuestions->id;
        $manageCommonQuestions->save();
        $showCommonQuestions   =  Permission::create(['name'  => 'show_common_questions', 'display_name'        =>  ['ar'   =>  'الاسئلة الشائعة',   'en'    =>  'Questions'], 'route' => 'common_questions', 'module' => 'common_questions', 'as' => 'common_questions.index', 'icon' => 'fas fa-question', 'parent' => $manageCommonQuestions->id, 'parent_original' => $manageCommonQuestions->id, 'parent_show' => $manageCommonQuestions->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCommonQuestions =  Permission::create(['name'  => 'create_common_questions', 'display_name'      =>  ['ar'   =>  'إنشاء سؤال',   'en'    =>  'Create Question'], 'route' => 'common_questions/create', 'module' => 'common_questions', 'as' => 'common_questions.create', 'icon' => null, 'parent' => $manageCommonQuestions->id, 'parent_original' => $manageCommonQuestions->id, 'parent_show' => $manageCommonQuestions->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayCommonQuestions =  Permission::create(['name' => 'display_common_questions', 'display_name'     =>  ['ar'   =>  'عرض سؤال',   'en'    =>  'Dispay Question'], 'route' => 'common_questions/{common_questions}', 'module' => 'common_questions', 'as' => 'common_questions.show', 'icon' => null, 'parent' => $manageCommonQuestions->id, 'parent_original' => $manageCommonQuestions->id, 'parent_show' => $manageCommonQuestions->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCommonQuestions  =  Permission::create(['name' => 'update_common_questions', 'display_name'      =>  ['ar'   =>  'تعديل سؤال',   'en'    =>  'Edit Question'], 'route' => 'common_questions/{common_questions}/edit', 'module' => 'common_questions', 'as' => 'common_questions.edit', 'icon' => null, 'parent' => $manageCommonQuestions->id, 'parent_original' => $manageCommonQuestions->id, 'parent_show' => $manageCommonQuestions->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCommonQuestions =  Permission::create(['name'  => 'delete_common_questions', 'display_name'      =>  ['ar'   =>  'حذف سؤال',   'en'    =>  'Delete Question'], 'route' => 'common_questions/{common_questions}', 'module' => 'common_questions', 'as' => 'common_questions.destroy', 'icon' => null, 'parent' => $manageCommonQuestions->id, 'parent_original' => $manageCommonQuestions->id, 'parent_show' => $manageCommonQuestions->id, 'sidebar_link' => '0', 'appear' => '0']);

        //Common Questions
        $manageNews = Permission::create(['name' => 'manage_news', 'display_name' => ['ar'  =>  'إدارة المدونة',    'en'    =>  'Manage Blogs'], 'route' => 'news', 'module' => 'news', 'as' => 'news.index', 'icon' => 'fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '105',]);
        $manageNews->parent_show = $manageNews->id;
        $manageNews->save();
        $showNews   =  Permission::create(['name'  => 'show_news', 'display_name'       =>  ['ar'   =>  'المنشورات',   'en'    =>  'Posts'], 'route' => 'news', 'module' => 'news', 'as' => 'news.index', 'icon' => 'fas fa-newspaper', 'parent' => $manageNews->id, 'parent_original' => $manageNews->id, 'parent_show' => $manageNews->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createNews =  Permission::create(['name'  => 'create_news', 'display_name'     =>  ['ar'   =>  'إنشاء منشور',   'en'    =>  'Create Post'], 'route' => 'news/create', 'module' => 'news', 'as' => 'news.create', 'icon' => null, 'parent' => $manageNews->id, 'parent_original' => $manageNews->id, 'parent_show' => $manageNews->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayNews =  Permission::create(['name' => 'display_news', 'display_name'    =>  ['ar'   =>  'عرض منشرو',   'en'    =>  'Display Post'], 'route' => 'news/{news}', 'module' => 'news', 'as' => 'news.show', 'icon' => null, 'parent' => $manageNews->id, 'parent_original' => $manageNews->id, 'parent_show' => $manageNews->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateNews  =  Permission::create(['name' => 'update_news', 'display_name'     =>  ['ar'   =>  'تعديل منشور',   'en'    =>  'Edit Post'], 'route' => 'news/{news}/edit', 'module' => 'news', 'as' => 'news.edit', 'icon' => null, 'parent' => $manageNews->id, 'parent_original' => $manageNews->id, 'parent_show' => $manageNews->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteNews =  Permission::create(['name'  => 'delete_news', 'display_name'     =>  ['ar'   =>  'حذف منشور',   'en'    =>  'Delete Post'], 'route' => 'news/{news}', 'module' => 'news', 'as' => 'news.destroy', 'icon' => null, 'parent' => $manageNews->id, 'parent_original' => $manageNews->id, 'parent_show' => $manageNews->id, 'sidebar_link' => '0', 'appear' => '0']);

        //payment Categories
        $managePaymentCategories = Permission::create(['name' => 'manage_payment_categories', 'display_name' => ['ar'   =>  'إدارة تصنيف طرق الدفع',   'en'    =>  'payment Categories'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '110',]);
        $managePaymentCategories->parent_show = $managePaymentCategories->id;
        $managePaymentCategories->save();
        $showPaymentCategories    =  Permission::create(['name' => 'show_payment_categories',  'display_name'   =>  ['ar'   =>  'تصنيف طرق الدفع',   'en'    =>  'Payment Categories'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.index', 'icon' => 'fas fa-file-archive', 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPaymentCategories  =  Permission::create(['name' => 'create_payment_categories', 'display_name'  =>  ['ar'   =>  'إضافة تصيف طريقة دفع',   'en'    =>  'Create Payment Category'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.create', 'icon' => null, 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayPaymentCategories =  Permission::create(['name' => 'display_payment_categories', 'display_name' =>  ['ar'   =>  'عرض تصنيف طريقة دفع',   'en'    =>  'Display Payment Category'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.show', 'icon' => null, 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePaymentCategories  =  Permission::create(['name' => 'update_payment_categories', 'display_name'  =>  ['ar'   =>  'تعديل تصنيف طريقة دفع',   'en'    =>  'Edit Payment Category'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.edit', 'icon' => null, 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePaymentCategories  =  Permission::create(['name' => 'delete_payment_categories', 'display_name'  =>  ['ar'   =>  'حذف تصنيف طريقة دفع',   'en'    =>  'Delete Payment Category'], 'route' => 'payment_categories', 'module' => 'payment_categories', 'as' => 'payment_categories.destroy', 'icon' => null, 'parent' => $managePaymentCategories->id, 'parent_original' => $managePaymentCategories->id, 'parent_show' => $managePaymentCategories->id, 'sidebar_link' => '0', 'appear' => '0']);

        //payment methodOffline
        $managePaymentMethodOfflines = Permission::create(['name' => 'manage_payment_method_offlines', 'display_name' => ['ar'  =>  'طرق الدفع',    'en'    =>  'Payment Methods'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.index', 'icon' => 'fa fa-list-ul', 'parent' => $managePaymentCategories->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '115',]);
        $managePaymentMethodOfflines->parent_show = $managePaymentMethodOfflines->id;
        $managePaymentMethodOfflines->save();
        $showPaymentMethodOfflines    =  Permission::create(['name' => 'show_payment_method_offlines',  'display_name'      =>  ['ar'   =>  'طرق الدفع',   'en'    =>  'Payment Methods Online'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.index', 'icon' => 'fa fa-list-ul', 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createPaymentMethodOfflines  =  Permission::create(['name' => 'create_payment_method_offlines', 'display_name'     =>  ['ar'   =>  'إضافة طريقة دفع ',   'en'    =>  'Create Payment Method'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.create', 'icon' => null, 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayPaymentMethodOfflines =  Permission::create(['name' => 'display_payment_method_offlines', 'display_name'    =>  ['ar'   =>  'عرض طريقة دفع',   'en'    =>  'Display Payment Method'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.show', 'icon' => null, 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updatePaymentMethodOfflines  =  Permission::create(['name' => 'update_payment_method_offlines', 'display_name'     =>  ['ar'   =>  'تعديل طريقة الدفع',   'en'    =>  'Edit Payment Method'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.edit', 'icon' => null, 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deletePaymentMethodOfflines  =  Permission::create(['name' => 'delete_payment_method_offlines', 'display_name'     =>  ['ar'   =>  'حذف طريقة الدفع',   'en'    =>  'Delete Payment Method'], 'route' => 'payment_method_offlines', 'module' => 'payment_method_offlines', 'as' => 'payment_method_offlines.destroy', 'icon' => null, 'parent' => $managePaymentMethodOfflines->id, 'parent_original' => $managePaymentMethodOfflines->id, 'parent_show' => $managePaymentMethodOfflines->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Site Settings Holder 
        $manageSiteSettings = Permission::create(['name' => 'manage_site_settings', 'display_name' => ['ar' =>  'الاعدادات العامة', 'en'    =>  'General Settings'], 'route' => 'settings', 'module' => 'settings', 'as' => 'settings.index', 'icon' => 'fa fa-cog', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '120',]);
        $manageSiteSettings->parent_show = $manageSiteSettings->id;
        $manageSiteSettings->save();

        //currencies
        $manageCurrencies = Permission::create(['name' => 'manage_currencies', 'display_name' => ['ar'  =>  'إدارة العملات', 'en'  =>  'Manage Currencies'], 'route' => 'currencies', 'module' => 'currencies', 'as' => 'currencies.index', 'icon' => 'fas fa-money-bill-alt', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '125',]);
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
        $displaySitePaymentMethods =  Permission::create(['name' => 'display_site_payment_methods', 'display_name'  =>  ['ar'   =>  'إدارة  طرق الدفع',   'en'    =>  'Manage Payment '], 'route' => 'settings.site_payment_methods', 'module' => 'settings.site_payment_methods', 'as' => 'settings.site_payment_methods.show', 'icon' => 'fas fa-dollar-sign', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        $updateSitePaymentMethods  =  Permission::create(['name' => 'update_site_payment_methods', 'display_name'   =>  ['ar'   =>  'تعديل طرق الدفع',   'en'    =>  'Edit Site Payment '], 'route' => 'settings.site_payment_methods', 'module' => 'settings.site_payment_methods', 'as' => 'settings.site_payment_methods.edit', 'icon' => null, 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '0', 'appear' => '0']);

        // Site counters 
        $displaySiteCounters =  Permission::create(['name' => 'display_site_counters', 'display_name'   =>  ['ar'   =>  'إدارة  عدادات الموقع',   'en'    =>  'Manage Counters'], 'route' => 'settings.site_counters', 'module' => 'settings.site_counters', 'as' => 'settings.site_counters.show', 'icon' => 'fas fa-calculator', 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        $updateSiteCounters  =  Permission::create(['name' => 'update_site_counters', 'display_name'    =>  ['ar'   =>  'تعديل عدادات الموقع',   'en'    =>  'Edit Site Counters'], 'route' => 'settings.site_counters', 'module' => 'settings.site_counters', 'as' => 'settings.site_counters.edit', 'icon' => null, 'parent' => $manageSiteSettings->id, 'parent_original' => $manageSiteSettings->id, 'parent_show' => $manageSiteSettings->id, 'sidebar_link' => '0', 'appear' => '0']);




        //Card Code 
        $manageCardCodes = Permission::create(['name' => 'manage_card_codes', 'display_name' => ['ar'   =>  'إدارة اكواد البطائق',   'en'    =>  'Manage Card Codes'], 'route' => 'card_codes', 'module' => 'card_codes', 'as' => 'card_codes.index', 'icon' => 'fas fa-file-archive', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '130',]);
        $manageCardCodes->parent_show = $manageCardCodes->id;
        $manageCardCodes->save();
        $showCardCodes    =  Permission::create(['name' => 'show_card_codes',  'display_name'   =>  ['ar'   =>  ' اكواد البطائق',   'en'    =>  'Card Codes'], 'route' => 'card_codes', 'module' => 'card_codes', 'as' => 'card_codes.index', 'icon' => 'fas fa-file-archive', 'parent' => $manageCardCodes->id, 'parent_original' => $manageCardCodes->id, 'parent_show' => $manageCardCodes->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createCardCodes  =  Permission::create(['name' => 'create_card_codes', 'display_name'  =>  ['ar'   =>  'إضافة كود بطاقة ',   'en'    =>  'Create Card Code'], 'route' => 'card_codes', 'module' => 'card_codes', 'as' => 'card_codes.create', 'icon' => null, 'parent' => $manageCardCodes->id, 'parent_original' => $manageCardCodes->id, 'parent_show' => $manageCardCodes->id, 'sidebar_link' => '0', 'appear' => '0']);
        $displayCardCodes =  Permission::create(['name' => 'display_card_codes', 'display_name' =>  ['ar'   =>  'عرض كود بطاقة ',   'en'    =>  'Display Card Code'], 'route' => 'card_codes', 'module' => 'card_codes', 'as' => 'card_codes.show', 'icon' => null, 'parent' => $manageCardCodes->id, 'parent_original' => $manageCardCodes->id, 'parent_show' => $manageCardCodes->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateCardCodes  =  Permission::create(['name' => 'update_card_codes', 'display_name'  =>  ['ar'   =>  'تعديل كود بطاقة ',   'en'    =>  'Edit Card Code'], 'route' => 'card_codes', 'module' => 'card_codes', 'as' => 'card_codes.edit', 'icon' => null, 'parent' => $manageCardCodes->id, 'parent_original' => $manageCardCodes->id, 'parent_show' => $manageCardCodes->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteCardCodes  =  Permission::create(['name' => 'delete_card_codes', 'display_name'  =>  ['ar'   =>  'حذف كود بطاقة ',   'en'    =>  'Delete Card Code'], 'route' => 'card_codes', 'module' => 'card_codes', 'as' => 'card_codes.destroy', 'icon' => null, 'parent' => $manageCardCodes->id, 'parent_original' => $manageCardCodes->id, 'parent_show' => $manageCardCodes->id, 'sidebar_link' => '0', 'appear' => '0']);



        // Account Settings
        $manageAccountSettings = Permission::create(['name' => 'manage_account_settings', 'display_name' => ['ar'   =>  'إدارة حسابات المشرفين',   'en'    =>  'Manage Supervisor Accounts'], 'route' => 'account_settings', 'module' => 'account_settings', 'as' => 'account_settings', 'icon' => 'fas fa-user', 'parent' => '0', 'parent_original' => '0', 'parent_show' => '0', 'sidebar_link' => '0', 'appear' => '1', 'ordering' => '1000',]);
        $manageAccountSettings->parent_show = $manageAccountSettings->id;
        $manageAccountSettings->save();
        $showAccountSettings    =  Permission::create(['name' => 'show_account_settings',  'display_name'       =>  ['ar'   =>  'إدارة حسابات المشرفين',   'en'    =>  'Supervisor Accounts'], 'route' => 'account_settings', 'module' => 'account_settings', 'as' => 'account_settings', 'icon' => 'fas fa-calculator', 'parent' => $manageAccountSettings->id, 'parent_original' => $manageAccountSettings->id, 'parent_show' => $manageAccountSettings->id, 'sidebar_link' => '1', 'appear' => '1']);
        $displayAccountSettings =  Permission::create(['name' => 'display_account_settings', 'display_name'     =>  ['ar'   =>  'عرض حسابات المشرفين ',   'en'    =>  'Dsiplay Supervisor Accounts'], 'route' => 'account_settings', 'module' => 'account_settings', 'as' => 'account_settings.show', 'icon' => null, 'parent' => $manageAccountSettings->id, 'parent_original' => $manageAccountSettings->id, 'parent_show' => $manageAccountSettings->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateAccountSettings  =  Permission::create(['name' => 'update_account_settings', 'display_name'      =>  ['ar'   =>  'تعديل حسابات المشرفين',   'en'    =>  'Edit Supervisor Accounts'], 'route' => 'account_settings', 'module' => 'account_settings', 'as' => 'update_account_settings', 'icon' => null, 'parent' => $manageAccountSettings->id, 'parent_original' => $manageAccountSettings->id, 'parent_show' => $manageAccountSettings->id, 'sidebar_link' => '0', 'appear' => '0']);


        //Product Reviews
        $manageProductReviews = Permission::create(['name' => 'manage_product_reviews', 'display_name' => ['ar' =>  'إدارة التعليقات',  'en'    =>  'Manage Comments'], 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '0', 'appear' => '0', 'ordering' => '2000',]);
        $manageProductReviews->parent_show = $manageProductReviews->id;
        $manageProductReviews->save();
        $showProductReviews   =  Permission::create(['name' => 'show_product_reviews',  'display_name'      =>  ['ar'   =>  'التعليقات',   'en'    =>  'Comments'], 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.index', 'icon' => 'fas fa-comment', 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '1']);
        $createProductReviews =  Permission::create(['name' => 'create_product_reviews', 'display_name'     =>  ['ar'   =>  'إضافة تعليق',   'en'    =>  'Create Comment'], 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.create', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
        $displayProductReviews =  Permission::create(['name' => 'display_product_reviews', 'display_name'   =>  ['ar'   =>  'عرض تعليق',   'en'    =>  'Display Comment'], 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.show', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
        $updateProductReviews  =  Permission::create(['name' => 'update_product_reviews', 'display_name'    =>  ['ar'   =>  'تعديل تعليق',   'en'    =>  'Edit Comment'], 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.edit', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
        $deleteProductReviews =  Permission::create(['name' => 'delete_product_reviews', 'display_name'     =>  ['ar'   =>  'حذف تعليق',   'en'    =>  'Delete Comment'], 'route' => 'product_reviews', 'module' => 'product_reviews', 'as' => 'product_reviews.destroy', 'icon' => null, 'parent' => $manageProductReviews->id, 'parent_original' => $manageProductReviews->id, 'parent_show' => $manageProductReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
    }
}
