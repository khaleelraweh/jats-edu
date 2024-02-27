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
        $adminRole->allowed_route= 'admin';
        $adminRole->save();

        //supervisorRole
        $supervisorRole = Role::create([
            'name'=>'supervisor',
            'display_name'=>'User Supervisor',
            'description'=>'Supervisor is allowed to manage and edit other users',
            'allowed_route'=>'admin',
        ]);


        //customerRole
        $customerRole = new Role();
        $customerRole->name         = 'customer';
        $customerRole->display_name = 'Project Customer'; // optional
        $customerRole->description  = 'Customer is the customer of a given project'; // optional
        $customerRole->allowed_route= null;
        $customerRole->save();


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
            'first_name'=>'Supervisor',
            'last_name'=>'System',
            'username'=>'supervisor',
            'email'=>'supervisor@gmail.com',
            'email_verified_at'=>now(),
            'mobile'=>'00967772036132',
            'password'=>bcrypt('123123123'),
            'user_image'=>'avator.svg',
            'status'=>1,
            'remember_token'=>Str::random(10),
        ]);

        // Create customer
        $customer = User::create([
            'first_name'=>'Khaleel',
            'last_name'=>'Raweh',
            'username'=>'khaleel',
            'email'=>'khaleelvisa@gmail.com',
            'email_verified_at'=>now(),
            'mobile'=>'00967772036133',
            'password'=>bcrypt('123123123'),
            'user_image'=>'avator.svg',
            'status'=>1,
            'remember_token'=>Str::random(10),
        ]);

        //------------- 03- AttachRoles To  Users  ------------//
        $admin->attachRole($adminRole);
        $supervisor->attachRole($supervisorRole);
        $customer->attachRole($customerRole);


        //------------- 04-  Create random customer and  AttachRole to customerRole  ------------//
        for ($i = 1; $i <= 20; $i++){
            //Create random customer
            $random_customer = User::create([
                'first_name'=>$faker->firstName,
                'last_name'=>$faker->lastName,
                'username'=>$faker->unique()->userName,
                'email'=>$faker->unique()->email,
                'email_verified_at'=>now(),
                'mobile'=>'0096777'.$faker->numberBetween(1000000,9999999),
                'password'=>bcrypt('123123123'),
                'user_image'=>'avator.svg',
                'status'=>1,
                'remember_token'=>Str::random(10),
            ]);

            //Add customerRole to RandomCusomer
            $random_customer->attachRole($customerRole);

        }//end for


        //------------- 05- Permission  ------------//
        //manage main dashboard page
        $manageMain = Permission::create(['name'=>'main', 'display_name'=>'الرئيسية', 'route'=>'index', 'module'=>'index', 'as'=>'index', 'icon'=>'ri-dashboard-line', 'parent'=>'0', 'parent_original'=>'0', 'sidebar_link'=>'1', 'appear'=>'1', 'ordering'=>'1']);
        $manageMain->parent_show = $manageMain->id;
        $manageMain->save();

        //web menus 
        $manageWebMenus = Permission::create(['name' => 'manage_web_menus', 'display_name' => 'إدارة القوائم' , 'route' => 'web_menus' , 'module' => 'web_menus' , 'as' => 'web_menus.index' , 'icon' => 'fa fa-list-ul' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '5',] );
        $manageWebMenus->parent_show = $manageWebMenus->id; $manageWebMenus->save();
        $showWebMenus    =  Permission::create(['name' => 'show_web_menus'    ,  'display_name' => 'إدارة القوائم الرئيسية'      , 'route' => 'web_menus' , 'module' => 'web_menus' , 'as' => 'web_menus.index'    , 'icon' => 'fa fa-list-ul' , 'parent' => $manageWebMenus->id , 'parent_original' => $manageWebMenus->id ,'parent_show' => $manageWebMenus->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createWebMenus  =  Permission::create(['name' => 'create_web_menus'  , 'display_name'  => 'إضافة تصنيف' , 'route' => 'web_menus' , 'module' => 'web_menus' , 'as' => 'web_menus.create'   , 'icon' => null                  , 'parent' => $manageWebMenus->id , 'parent_original' => $manageWebMenus->id ,'parent_show' => $manageWebMenus->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $displayWebMenus =  Permission::create(['name' => 'display_web_menus' , 'display_name'  => 'عرض تصنيف'   , 'route' => 'web_menus' , 'module' => 'web_menus' , 'as' => 'web_menus.show'     , 'icon' => null                  , 'parent' => $manageWebMenus->id , 'parent_original' => $manageWebMenus->id ,'parent_show' => $manageWebMenus->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateWebMenus  =  Permission::create(['name' => 'update_web_menus'  , 'display_name'  => 'تعديل تصنيف' , 'route' => 'web_menus' , 'module' => 'web_menus' , 'as' => 'web_menus.edit'     , 'icon' => null                  , 'parent' => $manageWebMenus->id , 'parent_original' => $manageWebMenus->id ,'parent_show' => $manageWebMenus->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteWebMenus  =  Permission::create(['name' => 'delete_web_menus'  , 'display_name'  => 'حذف تصنيف' , 'route' => 'web_menus' , 'module' => 'web_menus' , 'as' => 'web_menus.destroy'  , 'icon' => null                  , 'parent' => $manageWebMenus->id , 'parent_original' => $manageWebMenus->id ,'parent_show' => $manageWebMenus->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        
        //web menu helper
        $manageWebMenuHelps = Permission::create(['name' => 'manage_web_menu_helps', 'display_name' => 'إدارة قوائم المساعدة' , 'route' => 'web_menu_helps' , 'module' => 'web_menu_helps' , 'as' => 'web_menu_helps.index' , 'icon' => 'fa fa-list-ul' , 'parent' => $manageWebMenus->id , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '10',] );
        $manageWebMenuHelps->parent_show = $manageWebMenuHelps->id; $manageWebMenuHelps->save();
        $showWebMenuHelps    =  Permission::create(['name' => 'show_web_menu_helps'    ,  'display_name' => 'تصنيف قوائم المساعدة'      , 'route' => 'web_menu_helps' , 'module' => 'web_menu_helps' , 'as' => 'web_menu_helps.index'    , 'icon' => 'fa fa-list-ul' , 'parent' => $manageWebMenuHelps->id , 'parent_original' => $manageWebMenuHelps->id ,'parent_show' => $manageWebMenuHelps->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createWebMenuHelps  =  Permission::create(['name' => 'create_web_menu_helps'  , 'display_name'  => 'إضافة تصنيف' , 'route' => 'web_menu_helps' , 'module' => 'web_menu_helps' , 'as' => 'web_menu_helps.create'   , 'icon' => null                  , 'parent' => $manageWebMenuHelps->id , 'parent_original' => $manageWebMenuHelps->id ,'parent_show' => $manageWebMenuHelps->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $displayWebMenuHelps =  Permission::create(['name' => 'display_web_menu_helps' , 'display_name'  => 'عرض تصنيف'   , 'route' => 'web_menu_helps' , 'module' => 'web_menu_helps' , 'as' => 'web_menu_helps.show'     , 'icon' => null                  , 'parent' => $manageWebMenuHelps->id , 'parent_original' => $manageWebMenuHelps->id ,'parent_show' => $manageWebMenuHelps->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateWebMenuHelps  =  Permission::create(['name' => 'update_web_menu_helps'  , 'display_name'  => 'تعديل تصنيف' , 'route' => 'web_menu_helps' , 'module' => 'web_menu_helps' , 'as' => 'web_menu_helps.edit'     , 'icon' => null                  , 'parent' => $manageWebMenuHelps->id , 'parent_original' => $manageWebMenuHelps->id ,'parent_show' => $manageWebMenuHelps->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteWebMenuHelps  =  Permission::create(['name' => 'delete_web_menu_helps'  , 'display_name'  => 'حذف تصنيف' , 'route' => 'web_menu_helps' , 'module' => 'web_menu_helps' , 'as' => 'web_menu_helps.destroy'  , 'icon' => null                  , 'parent' => $manageWebMenuHelps->id , 'parent_original' => $manageWebMenuHelps->id ,'parent_show' => $manageWebMenuHelps->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //main sliders
        $manageMainSliders = Permission::create(['name' => 'manage_main_sliders', 'display_name' => 'إدارة عارض الشرائح' , 'route' => 'main_sliders' , 'module' => 'main_sliders' , 'as' => 'main_sliders.index' , 'icon' => 'fas fa-sliders-h' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '15',] );
        $manageMainSliders->parent_show = $manageMainSliders->id; $manageMainSliders->save();
        $showMainSliders    =  Permission::create(['name' => 'show_main_sliders'    , 'display_name' => 'عارض الشرائح الرئيسي'     , 'route' => 'main_sliders' , 'module' => 'main_sliders' , 'as' => 'main_sliders.index'    , 'icon' => 'fas  fa-sliders-h' , 'parent' => $manageMainSliders->id , 'parent_original' => $manageMainSliders->id ,'parent_show' => $manageMainSliders->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createMainSliders  =  Permission::create(['name' => 'create_main_sliders'  , 'display_name'  => 'إضافة شريحة جديد'        , 'route' => 'main_sliders' , 'module' => 'main_sliders' , 'as' => 'main_sliders.create'   , 'icon' => null                  , 'parent' => $manageMainSliders->id , 'parent_original' => $manageMainSliders->id ,'parent_show' => $manageMainSliders->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $displayMainSliders =  Permission::create(['name' => 'display_main_sliders' , 'display_name'  => 'عرض الشريحة'             ,  'route' => 'main_sliders' , 'module' => 'main_sliders' , 'as' => 'main_sliders.show'     , 'icon' => null                  , 'parent' => $manageMainSliders->id , 'parent_original' => $manageMainSliders->id ,'parent_show' => $manageMainSliders->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateMainSliders  =  Permission::create(['name' => 'update_main_sliders'  , 'display_name'  => 'تعديل الشريحة'           ,  'route' => 'main_sliders' , 'module' => 'main_sliders' , 'as' => 'main_sliders.edit'     , 'icon' => null                  , 'parent' => $manageMainSliders->id , 'parent_original' => $manageMainSliders->id ,'parent_show' => $manageMainSliders->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteMainSliders  =  Permission::create(['name' => 'delete_main_sliders'  , 'display_name'  => 'حذف الشريحة'             ,  'route' => 'main_sliders' , 'module' => 'main_sliders' , 'as' => 'main_sliders.destroy'  , 'icon' => null                  , 'parent' => $manageMainSliders->id , 'parent_original' => $manageMainSliders->id ,'parent_show' => $manageMainSliders->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        
        //Advertisor sliders
        $manageAdvertisorSliders = Permission::create(['name' => 'manage_advertisor_sliders', 'display_name' => ' عارض شرائح الإعلانات' , 'route' => 'advertisor_sliders' , 'module' => 'advertisor_sliders' , 'as' => 'advertisor_sliders.index' , 'icon' => 'fas fa-sliders-h' , 'parent' => $manageMainSliders->id , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '20',] );
        $manageAdvertisorSliders->parent_show = $manageAdvertisorSliders->id; $manageAdvertisorSliders->save();
        $showAdvertisorSliders    =  Permission::create(['name' => 'show_advertisor_sliders'    , 'display_name' => 'عارض شرائح الإعلانات'     , 'route' => 'advertisor_sliders' , 'module' => 'advertisor_sliders' , 'as' => 'advertisor_sliders.index'    , 'icon' => 'fas  fa-sliders-h' , 'parent' => $manageAdvertisorSliders->id , 'parent_original' => $manageAdvertisorSliders->id ,'parent_show' => $manageAdvertisorSliders->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createAdvertisorSliders  =  Permission::create(['name' => 'create_advertisor_sliders'  , 'display_name'  => 'إضافة شريحة جديد'        , 'route' => 'advertisor_sliders' , 'module' => 'advertisor_sliders' , 'as' => 'advertisor_sliders.create'   , 'icon' => null                  , 'parent' => $manageAdvertisorSliders->id , 'parent_original' => $manageAdvertisorSliders->id ,'parent_show' => $manageAdvertisorSliders->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $displayAdvertisorSliders =  Permission::create(['name' => 'display_advertisor_sliders' , 'display_name'  => 'عرض الشريحة'             ,  'route' => 'advertisor_sliders' , 'module' => 'advertisor_sliders' , 'as' => 'advertisor_sliders.show'     , 'icon' => null                  , 'parent' => $manageAdvertisorSliders->id , 'parent_original' => $manageAdvertisorSliders->id ,'parent_show' => $manageAdvertisorSliders->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateAdvertisorSliders  =  Permission::create(['name' => 'update_advertisor_sliders'  , 'display_name'  => 'تعديل الشريحة'           ,  'route' => 'advertisor_sliders' , 'module' => 'advertisor_sliders' , 'as' => 'advertisor_sliders.edit'     , 'icon' => null                  , 'parent' => $manageAdvertisorSliders->id , 'parent_original' => $manageAdvertisorSliders->id ,'parent_show' => $manageAdvertisorSliders->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteAdvertisorSliders  =  Permission::create(['name' => 'delete_advertisor_sliders'  , 'display_name'  => 'حذف الشريحة'             ,  'route' => 'advertisor_sliders' , 'module' => 'advertisor_sliders' , 'as' => 'advertisor_sliders.destroy'  , 'icon' => null                  , 'parent' => $manageAdvertisorSliders->id , 'parent_original' => $manageAdvertisorSliders->id ,'parent_show' => $manageAdvertisorSliders->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Procuct Categories
        $manageProductCategories = Permission::create(['name' => 'manage_product_categories', 'display_name' => 'إدارة المنتجات' , 'route' => 'product_categories' , 'module' => 'product_categories' , 'as' => 'product_categories.index' , 'icon' => 'fas fa-file-archive' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '25',] );
        $manageProductCategories->parent_show = $manageProductCategories->id; $manageProductCategories->save();
        $showProductCategories    =  Permission::create(['name' => 'show_product_categories'    ,  'display_name' => 'تصنيف المنتجات'      , 'route' => 'product_categories' , 'module' => 'product_categories' , 'as' => 'product_categories.index'    , 'icon' => 'fas fa-file-archive' , 'parent' => $manageProductCategories->id , 'parent_original' => $manageProductCategories->id ,'parent_show' => $manageProductCategories->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createProductCategories  =  Permission::create(['name' => 'create_product_categories'  , 'display_name'  => 'إضافة تصنيف' , 'route' => 'product_categories' , 'module' => 'product_categories' , 'as' => 'product_categories.create'   , 'icon' => null                  , 'parent' => $manageProductCategories->id , 'parent_original' => $manageProductCategories->id ,'parent_show' => $manageProductCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $displayProductCategories =  Permission::create(['name' => 'display_product_categories' , 'display_name'  => 'عرض تصنيف'   , 'route' => 'product_categories' , 'module' => 'product_categories' , 'as' => 'product_categories.show'     , 'icon' => null                  , 'parent' => $manageProductCategories->id , 'parent_original' => $manageProductCategories->id ,'parent_show' => $manageProductCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateProductCategories  =  Permission::create(['name' => 'update_product_categories'  , 'display_name'  => 'تعديل تصنيف' , 'route' => 'product_categories' , 'module' => 'product_categories' , 'as' => 'product_categories.edit'     , 'icon' => null                  , 'parent' => $manageProductCategories->id , 'parent_original' => $manageProductCategories->id ,'parent_show' => $manageProductCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteProductCategories  =  Permission::create(['name' => 'delete_product_categories'  , 'display_name'  => 'حذف تصنيف' , 'route' => 'product_categories' , 'module' => 'product_categories' , 'as' => 'product_categories.destroy'  , 'icon' => null                  , 'parent' => $manageProductCategories->id , 'parent_original' => $manageProductCategories->id ,'parent_show' => $manageProductCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        
        //Products 
        $manageProducts = Permission::create(['name' => 'manage_products', 'display_name' => 'المنتجات' , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.index' , 'icon' => 'fas fa-file-archive' , 'parent' => $manageProductCategories->id , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '30',] );
        $manageProducts->parent_show = $manageProducts->id; $manageProducts->save();
        $showProducts    =  Permission::create(['name' => 'show_products'    ,  'display_name' => 'المنتجات'       , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.index'    , 'icon' => 'fas fa-file-archive'  , 'parent' => $manageProducts->id , 'parent_original' => $manageProducts->id ,'parent_show' => $manageProducts->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createProducts  =  Permission::create(['name' => 'create_products'  , 'display_name'  => 'إضافة منتج'    , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.create'   , 'icon' => null           , 'parent' => $manageProducts->id , 'parent_original' => $manageProducts->id ,'parent_show' => $manageProducts->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayProducts =  Permission::create(['name' => 'display_products' , 'display_name'  => 'عرض منتج'            , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.show'     , 'icon' => null           , 'parent' => $manageProducts->id , 'parent_original' => $manageProducts->id ,'parent_show' => $manageProducts->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateProducts  =  Permission::create(['name' => 'update_products'  , 'display_name'  => 'تحديث منتج'          , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.edit'     , 'icon' => null           , 'parent' => $manageProducts->id , 'parent_original' => $manageProducts->id ,'parent_show' => $manageProducts->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteProducts  =  Permission::create(['name' => 'delete_products'  , 'display_name'  => 'حذف منتج'            , 'route' => 'products' , 'module' => 'products' , 'as' => 'products.destroy'  , 'icon' => null           , 'parent' => $manageProducts->id , 'parent_original' => $manageProducts->id ,'parent_show' => $manageProducts->id , 'sidebar_link' => '0' , 'appear' => '0'] );

         //manage card categories
         $manageCardCategories = Permission::create(['name' => 'manage_card_categories', 'display_name' => 'إدارة البطائق' , 'route' => 'card_categories' , 'module' => 'card_categories' , 'as' => 'card_categories.index' , 'icon' => 'fas fa-file-archive' , 'parent' => '0', 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '35',] );
         $manageCardCategories->parent_show = $manageCardCategories->id; $manageCardCategories->save();
         $showcard_categories    =  Permission::create(['name' => 'show_card_categories'    , 'display_name'  => 'تصنيف البطائق'        ,   'route' => 'card_categories' , 'module' => 'card_categories' , 'as' => 'card_categories.index'    , 'icon' => 'fas fa-file-archive' , 'parent' => $manageCardCategories->id , 'parent_original' => $manageCardCategories->id ,'parent_show' => $manageCardCategories->id , 'sidebar_link' => '1' , 'appear' => '1'] );
         $createcard_categories  =  Permission::create(['name' => 'create_card_categories'  , 'display_name'  => 'إنشاء تصنيف بطاقة'   ,    'route' => 'card_categories' , 'module' => 'card_categories' , 'as' => 'card_categories.create'   , 'icon' => null                  , 'parent' => $manageCardCategories->id , 'parent_original' => $manageCardCategories->id ,'parent_show' => $manageCardCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
         $displaycard_categories =  Permission::create(['name' => 'display_card_categories' , 'display_name'  => 'عرض عرض تصنيف بطاقة' ,    'route' => 'card_categories' , 'module' => 'card_categories' , 'as' => 'card_categories.show'     , 'icon' => null                  , 'parent' => $manageCardCategories->id , 'parent_original' => $manageCardCategories->id ,'parent_show' => $manageCardCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
         $updatecard_categories  =  Permission::create(['name' => 'update_card_categories'  , 'display_name'  => 'تعديل تصنيف بطاقة'   ,    'route' => 'card_categories' , 'module' => 'card_categories' , 'as' => 'card_categories.edit'     , 'icon' => null                  , 'parent' => $manageCardCategories->id , 'parent_original' => $manageCardCategories->id ,'parent_show' => $manageCardCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
         $deletecard_categories  =  Permission::create(['name' => 'delete_card_categories'  , 'display_name'  => 'حذف تصنيف بطاقة'     ,    'route' => 'card_categories' , 'module' => 'card_categories' , 'as' => 'card_categories.destroy'  , 'icon' => null                  , 'parent' => $manageCardCategories->id , 'parent_original' => $manageCardCategories->id ,'parent_show' => $manageCardCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
 
        //Manage cards 
        $manageCards = Permission::create(['name' => 'manage_cards', 'display_name' => 'الباقات' , 'route' => 'cards' , 'module' => 'cards' , 'as' => 'cards.index' , 'icon' => 'fas fa-file-archive' , 'parent' => $manageCardCategories->id , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '40',] );
        $manageCards->parent_show = $manageCards->id; $manageCards->save();
        $showCards   =  Permission::create(['name' => 'show_cards'    ,   'display_name'    => 'عرض الباقات'         ,   'route'     => 'cards'   , 'module'   => 'cards' , 'as' =>  'cards.index'    , 'icon' => 'fas fa-file-archive'  , 'parent' => $manageCards->id , 'parent_original' => $manageCards->id ,'parent_show' => $manageCards->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createCards =  Permission::create(['name' => 'create_cards'  ,   'display_name'    => 'إضافة باقة جديدة'  ,   'route'     => 'cards'    , 'module'  => 'cards' , 'as' =>   'cards.create'   , 'icon' => null           , 'parent' => $manageCards->id , 'parent_original' => $manageCards->id ,'parent_show' => $manageCards->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayCards=  Permission::create(['name' => 'display_cards' ,   'display_name'    => 'عرض باقة'            ,   'route'     => 'cards'   ,  'module'  => 'cards' , 'as' =>  'cards.show'     , 'icon' => null           , 'parent' => $manageCards->id , 'parent_original' => $manageCards->id ,'parent_show' => $manageCards->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateCards =  Permission::create(['name' => 'update_cards'  ,   'display_name'    => 'تحديث بطاقة'         ,   'route'     => 'cards'   , 'module'   => 'cards' , 'as' =>  'cards.edit'     , 'icon' => null           , 'parent' => $manageCards->id , 'parent_original' => $manageCards->id ,'parent_show' => $manageCards->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteCards =  Permission::create(['name' => 'delete_cards'  ,   'display_name'    => 'حذف بطاقة'           ,   'route'     => 'cards'   , 'module'   => 'cards' , 'as' =>  'cards.destroy'  , 'icon' => null           , 'parent' => $manageCards->id , 'parent_original' => $manageCards->id ,'parent_show' => $manageCards->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Product Tags
        $manageTags = Permission::create(['name' => 'manage_tags', 'display_name' => 'إدارة الكلمات المفتاحية' , 'route' => 'tags' , 'module' => 'tags' , 'as' => 'tags.index' , 'icon' => 'fas fa-tags' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '45',] );
        $manageTags->parent_show = $manageTags->id; $manageTags->save();
        $showTags    =  Permission::create(['name' => 'show_tags'    ,  'display_name' => 'عرض الكلمات المفتاحية'       , 'route' => 'tags' , 'module' => 'tags' , 'as' => 'tags.index'    , 'icon' => 'fas fa-tags'  , 'parent' => $manageTags->id , 'parent_original' => $manageTags->id ,'parent_show' => $manageTags->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createTags  =  Permission::create(['name' => 'create_tags'  , 'display_name'  => 'إضافة كلمة مفتاحية' , 'route' => 'tags' , 'module' => 'tags' , 'as' => 'tags.create'   , 'icon' => null           , 'parent' => $manageTags->id , 'parent_original' => $manageTags->id ,'parent_show' => $manageTags->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayTags =  Permission::create(['name' => 'display_tags' , 'display_name'  => 'استعراض كلمة مفتاحية'   , 'route' => 'tags' , 'module' => 'tags' , 'as' => 'tags.show'     , 'icon' => null           , 'parent' => $manageTags->id , 'parent_original' => $manageTags->id ,'parent_show' => $manageTags->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateTags  =  Permission::create(['name' => 'update_tags'  , 'display_name'  => 'تعديل كلمة مفتاحية' , 'route' => 'tags' , 'module' => 'tags' , 'as' => 'tags.edit'     , 'icon' => null           , 'parent' => $manageTags->id , 'parent_original' => $manageTags->id ,'parent_show' => $manageTags->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteTags  =  Permission::create(['name' => 'delete_tags'  , 'display_name'  => 'حذف لكمة مفتاحية' , 'route' => 'tags' , 'module' => 'tags' , 'as' => 'tags.destroy'  , 'icon' => null           , 'parent' => $manageTags->id , 'parent_original' => $manageTags->id ,'parent_show' => $manageTags->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Coupons
        $manageCoupons = Permission::create(['name' => 'manage_coupons', 'display_name' => 'إدارة كوبونات الخصم' , 'route' => 'coupons' , 'module' => 'coupons' , 'as' => 'coupons.index' , 'icon' => 'fas fa-percent' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '50',] );
        $manageCoupons->parent_show = $manageCoupons->id; $manageCoupons->save();
        $showProductCoupons    =  Permission::create(['name' => 'show_coupons'    ,  'display_name'  => 'كوبونات الخصم'       , 'route' => 'coupons' , 'module' => 'coupons' , 'as' => 'coupons.index'    , 'icon' => 'fas fa-percent'  , 'parent' => $manageCoupons->id , 'parent_original' => $manageCoupons->id ,'parent_show' => $manageCoupons->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createProductCoupons  =  Permission::create(['name' => 'create_coupons'  , 'display_name'   => 'إنشاء كوبون ' , 'route' => 'coupons' , 'module' => 'coupons' , 'as' => 'coupons.create'   , 'icon' => null              , 'parent' => $manageCoupons->id , 'parent_original' => $manageCoupons->id ,'parent_show' => $manageCoupons->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayProductCoupons =  Permission::create(['name' => 'display_coupons' , 'display_name'  => 'عرض كوبون'   , 'route' => 'coupons' , 'module' => 'coupons' , 'as' => 'coupons.show'     , 'icon' => null              , 'parent' => $manageCoupons->id , 'parent_original' => $manageCoupons->id ,'parent_show' => $manageCoupons->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateProductCoupons  =  Permission::create(['name' => 'update_coupons'  , 'display_name'  => 'تحديث كوبون' , 'route' => 'coupons' , 'module' => 'coupons' , 'as' => 'coupons.edit'     , 'icon' => null              , 'parent' => $manageCoupons->id , 'parent_original' => $manageCoupons->id ,'parent_show' => $manageCoupons->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteProductCoupons  =  Permission::create(['name' => 'delete_coupons'  , 'display_name'   => 'حذف كوبون' , 'route' => 'coupons' , 'module' => 'coupons' , 'as' => 'coupons.destroy'  , 'icon' => null              , 'parent' => $manageCoupons->id , 'parent_original' => $manageCoupons->id ,'parent_show' => $manageCoupons->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Customers
        $manageCustomers = Permission::create(['name' => 'manage_customers', 'display_name' => 'إدارة العملاء' , 'route' => 'customers' , 'module' => 'customers' , 'as' => 'customers.index' , 'icon' => 'fas fa-user' , 'parent' => '0' , 'parent_original' => '0' ,  'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '55',] );
        $manageCustomers->parent_show = $manageCustomers->id; $manageCustomers->save();
        $showCustomers   =  Permission::create(['name'  => 'show_customers'      , 'display_name'    => 'العملاء'             , 'route' => 'customers' , 'module' => 'customers' , 'as' => 'customers.index'    , 'icon' => 'fas fa-user'     , 'parent' => $manageCustomers->id , 'parent_original' => $manageCustomers->id ,'parent_show' => $manageCustomers->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createCustomers =  Permission::create(['name'  => 'create_customers'    , 'display_name'    => 'إضافة عميل'       , 'route' => 'customers' , 'module' => 'customers' , 'as' => 'customers.create'   , 'icon' => null              , 'parent' => $manageCustomers->id , 'parent_original' => $manageCustomers->id ,'parent_show' => $manageCustomers->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayCustomers =  Permission::create(['name' => 'display_customers'  , 'display_name'     => 'عرض عميل'         , 'route' => 'customers' , 'module' => 'customers' , 'as' => 'customers.show'     , 'icon' => null              , 'parent' => $manageCustomers->id , 'parent_original' => $manageCustomers->id ,'parent_show' => $manageCustomers->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateCustomers  =  Permission::create(['name' => 'update_customers'   , 'display_name'     => 'تحديث عميل'       , 'route' => 'customers' , 'module' => 'customers' , 'as' => 'customers.edit'     , 'icon' => null              , 'parent' => $manageCustomers->id , 'parent_original' => $manageCustomers->id ,'parent_show' => $manageCustomers->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteCustomers =  Permission::create(['name'  => 'delete_customers'    , 'display_name'    => 'حذف عميل'       , 'route' => 'customers' , 'module' => 'customers' , 'as' => 'customers.destroy'  , 'icon' => null              , 'parent' => $manageCustomers->id , 'parent_original' => $manageCustomers->id ,'parent_show' => $manageCustomers->id , 'sidebar_link' => '0' , 'appear' => '0'] );

         //Supervisor // we can hide suppervisor not to be in sidebar linke by  making in manage_supervisors 'sidebar_link' => '0'
        $manageSupervisors = Permission::create(['name' => 'manage_supervisors', 'display_name' => 'المشرفين' , 'route' => 'supervisors' , 'module' => 'supervisors' , 'as' => 'supervisors.index' , 'icon' => 'fas fa-user' , 'parent' => $manageCustomers->id , 'parent_original' => '0' , 'parent_show' => $manageCustomers->id  , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '60',] );
        $manageSupervisors->parent_show = $manageSupervisors->id; $manageSupervisors->save();
        $showSupervisors   =  Permission::create(['name' => 'show_supervisors'      , 'display_name'    => 'المشرفين'       , 'route' => 'supervisors' , 'module' => 'supervisors' , 'as' => 'supervisors.index'    , 'icon' => 'fas fa-user'     , 'parent' => $manageSupervisors->id , 'parent_original' => $manageSupervisors->id ,'parent_show' => $manageSupervisors->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createSupervisors =  Permission::create(['name' => 'create_supervisors'    , 'display_name'    => 'إضافة مشرف جديد' , 'route' => 'supervisors' , 'module' => 'supervisors' , 'as' => 'supervisors.create'   , 'icon' => null              , 'parent' => $manageSupervisors->id , 'parent_original' => $manageSupervisors->id ,'parent_show' => $manageSupervisors->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displaySupervisors =  Permission::create(['name' => 'display_supervisors'  , 'display_name'    => 'عرض مشرف'   , 'route' => 'supervisors' , 'module' => 'supervisors' , 'as' => 'supervisors.show'     , 'icon' => null              , 'parent' => $manageSupervisors->id , 'parent_original' => $manageSupervisors->id ,'parent_show' => $manageSupervisors->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateSupervisors  =  Permission::create(['name' => 'update_supervisors'   , 'display_name'    => 'تعديل مشرف' , 'route' => 'supervisors' , 'module' => 'supervisors' , 'as' => 'supervisors.edit'     , 'icon' => null              , 'parent' => $manageSupervisors->id , 'parent_original' => $manageSupervisors->id ,'parent_show' => $manageSupervisors->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteSupervisors =  Permission::create(['name' => 'delete_supervisors'    , 'display_name'    => 'حذف مشرف' , 'route' => 'supervisors' , 'module' => 'supervisors' , 'as' => 'supervisors.destroy'  , 'icon' => null              , 'parent' => $manageSupervisors->id , 'parent_original' => $manageSupervisors->id ,'parent_show' => $manageSupervisors->id , 'sidebar_link' => '0' , 'appear' => '0'] );

         //userAddresses
        $manageCustomerAddresses = Permission::create(['name' => 'manage_customer_addresses', 'display_name' => 'إدارة عناوين العملاء ' , 'route' => 'customer_addresses' , 'module' => 'customer_addresses' , 'as' => 'customer_addresses.index' , 'icon' => 'fas fa-map-marked-alt' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '65',] );
        $manageCustomerAddresses->parent_show = $manageCustomerAddresses->id; $manageCustomerAddresses->save();
        $showCustomerAddresses   =  Permission::create(['name'  => 'show_customer_addresses'      , 'display_name'    => 'عناوين العملاء'             , 'route' => 'customer_addresses' , 'module' => 'customer_addresses' , 'as' => 'customer_addresses.index'    , 'icon' => 'fas fa-map-marked-alt'     , 'parent' => $manageCustomerAddresses->id , 'parent_original' => $manageCustomerAddresses->id ,'parent_show' => $manageCustomerAddresses->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createCustomerAddresses =  Permission::create(['name'  => 'create_customer_addresses'    , 'display_name'    => 'إنشاء عنوان جديد'       , 'route' => 'customer_addresses' , 'module' => 'customer_addresses' , 'as' => 'customer_addresses.create'   , 'icon' => null              , 'parent' => $manageCustomerAddresses->id , 'parent_original' => $manageCustomerAddresses->id ,'parent_show' => $manageCustomerAddresses->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayCustomerAddresses =  Permission::create(['name' => 'display_customer_addresses'  , 'display_name'     => 'عرض عنوان'         , 'route' => 'customer_addresses' , 'module' => 'customer_addresses' , 'as' => 'customer_addresses.show'     , 'icon' => null              , 'parent' => $manageCustomerAddresses->id , 'parent_original' => $manageCustomerAddresses->id ,'parent_show' => $manageCustomerAddresses->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateCustomerAddresses  =  Permission::create(['name' => 'update_customer_addresses'   , 'display_name'     => 'تعديل عنوان'       , 'route' => 'customer_addresses' , 'module' => 'customer_addresses' , 'as' => 'customer_addresses.edit'     , 'icon' => null              , 'parent' => $manageCustomerAddresses->id , 'parent_original' => $manageCustomerAddresses->id ,'parent_show' => $manageCustomerAddresses->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteCustomerAddresses =  Permission::create(['name'  => 'delete_customer_addresses'    , 'display_name'    => 'حذف عنوان'       , 'route' => 'customer_addresses' , 'module' => 'customer_addresses' , 'as' => 'customer_addresses.destroy'  , 'icon' => null              , 'parent' => $manageCustomerAddresses->id , 'parent_original' => $manageCustomerAddresses->id ,'parent_show' => $manageCustomerAddresses->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Countries
        $manageCountries = Permission::create(  ['name' => 'manage_countries', 'display_name' => 'إدارة البلدان' , 'route' => 'countries' , 'module' => 'countries' , 'as' => 'countries.index' , 'icon' => 'fas fa-globe' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '70',] );
        $manageCountries->parent_show = $manageCountries->id; $manageCountries->save();
        $showCountries   =  Permission::create( ['name'     => 'show_countries'    , 'display_name'  => 'الدول'       , 'route' => 'countries' , 'module' => 'countries' , 'as' => 'countries.index'    , 'icon' => 'fas fa-globe'    , 'parent' => $manageCountries->id , 'parent_original' => $manageCountries->id ,  'parent_show' => $manageCountries->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createCountries =  Permission::create( ['name'     => 'create_countries'  , 'display_name'  => 'إضافة دولة'  , 'route' => 'countries' , 'module' => 'countries' , 'as' => 'countries.create'   , 'icon' => null              , 'parent' => $manageCountries->id , 'parent_original' => $manageCountries->id ,  'parent_show' => $manageCountries->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayCountries =  Permission::create(['name'     => 'display_countries' , 'display_name'  => 'عرض بيانات الدولة'    , 'route' => 'countries' , 'module' => 'countries' , 'as' => 'countries.show'     , 'icon' => null              , 'parent' => $manageCountries->id , 'parent_original' => $manageCountries->id ,  'parent_show' => $manageCountries->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateCountries  =  Permission::create(['name'     => 'update_countries'  , 'display_name'  => 'تعديل بيانات الدولة'  , 'route' => 'countries' , 'module' => 'countries' , 'as' => 'countries.edit'     , 'icon' => null              , 'parent' => $manageCountries->id , 'parent_original' => $manageCountries->id ,  'parent_show' => $manageCountries->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteCountries =  Permission::create( ['name'     => 'delete_countries'  , 'display_name'  => 'حذف الدولة'  , 'route' => 'countries' , 'module' => 'countries' , 'as' => 'countries.destroy'  , 'icon' => null              , 'parent' => $manageCountries->id , 'parent_original' => $manageCountries->id ,  'parent_show' => $manageCountries->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //States
        $manageStates = Permission::create(['name' => 'manage_states', 'display_name' => 'المحافظات' , 'route' => 'states' , 'module' => 'states' , 'as' => 'states.index' , 'icon' => 'fas fa-map-marker-alt' , 'parent' =>  $manageCountries->id , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '75',] );
        $manageStates->parent_show = $manageStates->id; $manageStates->save();
        $showStates     =  Permission::create(['name' => 'show_states'     , 'display_name'    => 'المحافظات'             , 'route' => 'states' , 'module' => 'states' , 'as' => 'states.index'    , 'icon' => 'fas fa-map-marker-alt'   , 'parent' => $manageStates->id , 'parent_original' => $manageStates->id ,'parent_show' => $manageStates->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createStates   =  Permission::create(['name' => 'create_states'   , 'display_name'    => 'إضافة محافظة'       , 'route' => 'states' , 'module' => 'states' , 'as' => 'states.create'   , 'icon' => null              , 'parent' => $manageStates->id , 'parent_original' => $manageStates->id ,'parent_show' => $manageStates->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayStates  =  Permission::create(['name' => 'display_states'  , 'display_name'    => 'عرض محافظة'         , 'route' => 'states' , 'module' => 'states' , 'as' => 'states.show'     , 'icon' => null              , 'parent' => $manageStates->id , 'parent_original' => $manageStates->id ,'parent_show' => $manageStates->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateStates   =  Permission::create(['name' => 'update_states'   , 'display_name'    => 'تعديل محافظة'       , 'route' => 'states' , 'module' => 'states' , 'as' => 'states.edit'     , 'icon' => null              , 'parent' => $manageStates->id , 'parent_original' => $manageStates->id ,'parent_show' => $manageStates->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteStates   =  Permission::create(['name' => 'delete_states'   , 'display_name'    => 'حذف بيانات المدينة'       , 'route' => 'states' , 'module' => 'states' , 'as' => 'states.destroy'  , 'icon' => null              , 'parent' => $manageStates->id , 'parent_original' => $manageStates->id ,'parent_show' => $manageStates->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Cities
        $manageCities = Permission::create(['name' => 'manage_cities', 'display_name' => 'المدن' , 'route' => 'cities' , 'module' => 'cities' , 'as' => 'cities.index' , 'icon' => 'fas fa-university' , 'parent' =>  $manageCountries->id , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '80',] );
        $manageCities->parent_show = $manageCities->id; $manageCities->save();
        $showCities     =  Permission::create(['name' => 'show_cities'     , 'display_name'    => 'المدن'             , 'route' => 'cities' , 'module' => 'cities' , 'as' => 'cities.index'    , 'icon' => 'fas fa-university'   , 'parent' => $manageCities->id , 'parent_original' => $manageCities->id ,'parent_show' => $manageCities->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createCities   =  Permission::create(['name' => 'create_cities'   , 'display_name'    => 'إذافة مدينة'       , 'route' => 'cities' , 'module' => 'cities' , 'as' => 'cities.create'   , 'icon' => null              , 'parent' => $manageCities->id , 'parent_original' => $manageCities->id ,'parent_show' => $manageCities->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayCities  =  Permission::create(['name' => 'display_cities'  , 'display_name'    => 'عرض مدينة'         , 'route' => 'cities' , 'module' => 'cities' , 'as' => 'cities.show'     , 'icon' => null              , 'parent' => $manageCities->id , 'parent_original' => $manageCities->id ,'parent_show' => $manageCities->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateCities   =  Permission::create(['name' => 'update_cities'   , 'display_name'    => 'تعديل بيانات المدينة'       , 'route' => 'cities' , 'module' => 'cities' , 'as' => 'cities.edit'     , 'icon' => null              , 'parent' => $manageCities->id , 'parent_original' => $manageCities->id ,'parent_show' => $manageCities->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteCities   =  Permission::create(['name' => 'delete_cities'   , 'display_name'    => 'حذف بيانات المدينة'       , 'route' => 'cities' , 'module' => 'cities' , 'as' => 'cities.destroy'  , 'icon' => null              , 'parent' => $manageCities->id , 'parent_original' => $manageCities->id ,'parent_show' => $manageCities->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Shipping Companies
        $manageShippingCompanies = Permission::create(['name' => 'manage_shipping_companies', 'display_name' => 'إدارة شركات الشحن' , 'route' => 'shipping_companies' , 'module' => 'shipping_companies' , 'as' => 'shipping_companies.index' , 'icon' => 'fas fa-map-marked-alt' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '85',] );
        $manageShippingCompanies->parent_show = $manageShippingCompanies->id; $manageShippingCompanies->save();
        $showShippingCompanies   =  Permission::create(['name'  => 'show_shipping_companies'      , 'display_name'    => 'شركات الشحن'            , 'route' => 'shipping_companies' , 'module' => 'shipping_companies' , 'as' => 'shipping_companies.index'    , 'icon' => 'fas fa-map-marked-alt'     , 'parent' => $manageShippingCompanies->id , 'parent_original' => $manageShippingCompanies->id ,'parent_show' => $manageShippingCompanies->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createShippingCompanies =  Permission::create(['name'  => 'create_shipping_companies'    , 'display_name'    => 'إضافة شركة شحن جديدة'       , 'route' => 'shipping_companies' , 'module' => 'shipping_companies' , 'as' => 'shipping_companies.create'   , 'icon' => null              , 'parent' => $manageShippingCompanies->id , 'parent_original' => $manageShippingCompanies->id ,'parent_show' => $manageShippingCompanies->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayShippingCompanies=  Permission::create(['name'  => 'display_shipping_companies'   , 'display_name'    => 'عرض شركة الشحن'         , 'route' => 'shipping_companies' , 'module' => 'shipping_companies' , 'as' => 'shipping_companies.show'     , 'icon' => null              , 'parent' => $manageShippingCompanies->id , 'parent_original' => $manageShippingCompanies->id ,'parent_show' => $manageShippingCompanies->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateShippingCompanies =  Permission::create(['name'  => 'update_shipping_companies'    , 'display_name'    => 'تحديث بيانات شركة الشحن'       , 'route' => 'shipping_companies' , 'module' => 'shipping_companies' , 'as' => 'shipping_companies.edit'     , 'icon' => null              , 'parent' => $manageShippingCompanies->id , 'parent_original' => $manageShippingCompanies->id ,'parent_show' => $manageShippingCompanies->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteShippingCompanies =  Permission::create(['name'  => 'delete_shipping_companies'    , 'display_name'    => 'حذف شركة الشحن'       , 'route' => 'shipping_companies' , 'module' => 'shipping_companies' , 'as' => 'shipping_companies.destroy'  , 'icon' => null              , 'parent' => $manageShippingCompanies->id , 'parent_original' => $manageShippingCompanies->id ,'parent_show' => $manageShippingCompanies->id , 'sidebar_link' => '0' , 'appear' => '0'] );


        //Product Reviews
        $manageProductReviews = Permission::create(['name' => 'manage_product_reviews', 'display_name' => 'إدارة التعليقات' , 'route' => 'product_reviews' , 'module' => 'product_reviews' , 'as' => 'product_reviews.index' , 'icon' => 'fas fa-comment' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '90',] );
        $manageProductReviews->parent_show = $manageProductReviews->id; $manageProductReviews->save();
        $showProductReviews   =  Permission::create(['name' => 'show_product_reviews'    ,  'display_name'  => 'التعليقات'       , 'route' => 'product_reviews' , 'module' => 'product_reviews' , 'as' => 'product_reviews.index'    , 'icon' => 'fas fa-comment'  , 'parent' => $manageProductReviews->id , 'parent_original' => $manageProductReviews->id ,'parent_show' => $manageProductReviews->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createProductReviews =  Permission::create(['name' => 'create_product_reviews'  , 'display_name'   => 'إضافة تعليق' , 'route' => 'product_reviews' , 'module' => 'product_reviews' , 'as' => 'product_reviews.create'   , 'icon' => null              , 'parent' => $manageProductReviews->id , 'parent_original' => $manageProductReviews->id ,'parent_show' => $manageProductReviews->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayProductReviews =  Permission::create(['name' => 'display_product_reviews' , 'display_name'  => 'عرض تعليق'   , 'route' => 'product_reviews' , 'module' => 'product_reviews' , 'as' => 'product_reviews.show'     , 'icon' => null              , 'parent' => $manageProductReviews->id , 'parent_original' => $manageProductReviews->id ,'parent_show' => $manageProductReviews->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateProductReviews  =  Permission::create(['name' => 'update_product_reviews'  , 'display_name'  => 'تعديل تعليق' , 'route' => 'product_reviews' , 'module' => 'product_reviews' , 'as' => 'product_reviews.edit'     , 'icon' => null              , 'parent' => $manageProductReviews->id , 'parent_original' => $manageProductReviews->id ,'parent_show' => $manageProductReviews->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteProductReviews =  Permission::create(['name' => 'delete_product_reviews'  , 'display_name'   => 'حذف تعليق' , 'route' => 'product_reviews' , 'module' => 'product_reviews' , 'as' => 'product_reviews.destroy'  , 'icon' => null              , 'parent' => $manageProductReviews->id , 'parent_original' => $manageProductReviews->id ,'parent_show' => $manageProductReviews->id , 'sidebar_link' => '0' , 'appear' => '0'] );


        //Payment Methods
        $managePaymentMethods = Permission::create(['name' => 'manage_payment_methods', 'display_name' => 'إدارة شركات الدفع' , 'route' => 'payment_methods' , 'module' => 'payment_methods' , 'as' => 'payment_methods.index' , 'icon' => 'fas fa-dollar-sign' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '95',] );
        $managePaymentMethods->parent_show = $managePaymentMethods->id; $managePaymentMethods->save();
        $showPaymentMethods   =  Permission::create(['name'  => 'show_payment_methods'      , 'display_name'    => 'شركات الدفع'             , 'route' => 'payment_methods' , 'module' => 'payment_methods' , 'as' => 'payment_methods.index'    , 'icon' => 'fas fa-dollar-sign'     , 'parent' => $managePaymentMethods->id , 'parent_original' => $managePaymentMethods->id ,'parent_show' => $managePaymentMethods->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createPaymentMethods =  Permission::create(['name'  => 'create_payment_methods'    , 'display_name'    => 'إضافة شركة دفع'       , 'route' => 'payment_methods/create' , 'module' => 'payment_methods' , 'as' => 'payment_methods.create'   , 'icon' => null              , 'parent' => $managePaymentMethods->id , 'parent_original' => $managePaymentMethods->id ,'parent_show' => $managePaymentMethods->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayPaymentMethods=  Permission::create(['name'  => 'display_payment_methods'   , 'display_name'    => 'عرض شركة دفع'         , 'route' => 'payment_methods/{payment_methods}' , 'module' => 'payment_methods' , 'as' => 'payment_methods.show'     , 'icon' => null              , 'parent' => $managePaymentMethods->id , 'parent_original' => $managePaymentMethods->id ,'parent_show' => $managePaymentMethods->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updatePaymentMethods =  Permission::create(['name'  => 'update_payment_methods'    , 'display_name'    => 'تحديث بيانات شركة الدفع'       , 'route' => 'payment_methods/{payment_methods}/edit' , 'module' => 'payment_methods' , 'as' => 'payment_methods.edit'     , 'icon' => null              , 'parent' => $managePaymentMethods->id , 'parent_original' => $managePaymentMethods->id ,'parent_show' => $managePaymentMethods->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deletePaymentMethods =  Permission::create(['name'  => 'delete_payment_methods'    , 'display_name'    => 'حذف شركة الدفع'       , 'route' => 'payment_methods/{payment_methods}' , 'module' => 'payment_methods' , 'as' => 'payment_methods.destroy'  , 'icon' => null              , 'parent' => $managePaymentMethods->id , 'parent_original' => $managePaymentMethods->id ,'parent_show' => $managePaymentMethods->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Customer Orders
        $manageOrders = Permission::create(['name' => 'manage_orders', 'display_name' => 'إدارة الطلبات'                      , 'route' => 'orders' , 'module' => 'orders' , 'as' => 'orders.index' , 'icon' => 'fas fa-shopping-basket'            , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '100',] );
        $manageOrders->parent_show = $manageOrders->id; $manageOrders->save();
        $showOrders   =  Permission::create(['name'  => 'show_orders'      , 'display_name'    => 'الطلبات'             , 'route' => 'orders'                , 'module' => 'orders' , 'as' => 'orders.index'    , 'icon' => 'fas fa-shopping-basket'     , 'parent' => $manageOrders->id , 'parent_original' => $manageOrders->id ,'parent_show' => $manageOrders->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createOrders =  Permission::create(['name'  => 'create_orders'    , 'display_name'    => 'إنشاء طلب جديد'       , 'route' => 'orders/create'         , 'module' => 'orders' , 'as' => 'orders.create'   , 'icon' => null              , 'parent' => $manageOrders->id , 'parent_original' => $manageOrders->id ,'parent_show' => $manageOrders->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayOrders =  Permission::create(['name' => 'display_orders'  , 'display_name'     => 'عرض الطلب'         , 'route' => 'orders/{orders}'       , 'module' => 'orders' , 'as' => 'orders.show'     , 'icon' => null              , 'parent' => $manageOrders->id , 'parent_original' => $manageOrders->id ,'parent_show' => $manageOrders->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateOrders  =  Permission::create(['name' => 'update_orders'   , 'display_name'     => 'تحديث الطلب'       , 'route' => 'orders/{orders}/edit'  , 'module' => 'orders' , 'as' => 'orders.edit'     , 'icon' => null              , 'parent' => $manageOrders->id , 'parent_original' => $manageOrders->id ,'parent_show' => $manageOrders->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteOrders =  Permission::create(['name'  => 'delete_orders'    , 'display_name'    => 'حذف الطلب'       , 'route' => 'orders/{orders}'       , 'module' => 'orders' , 'as' => 'orders.destroy'  , 'icon' => null              , 'parent' => $manageOrders->id , 'parent_original' => $manageOrders->id ,'parent_show' => $manageOrders->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Common Questions
        $manageCommonQuestions = Permission::create(['name' => 'manage_common_questions', 'display_name' => 'إدارة الاسئلة الشائعة'         , 'route' => 'common_questions' , 'module' => 'common_questions' , 'as' => 'common_questions.index' , 'icon' => 'fas fa-question'            , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '100',] );
        $manageCommonQuestions->parent_show = $manageCommonQuestions->id; $manageCommonQuestions->save();
        $showCommonQuestions   =  Permission::create(['name'  => 'show_common_questions'      , 'display_name'    => 'الاسئلة الشائعة'             , 'route' => 'common_questions'                , 'module' => 'common_questions' , 'as' => 'common_questions.index'    , 'icon' => 'fas fa-question'     , 'parent' => $manageCommonQuestions->id , 'parent_original' => $manageCommonQuestions->id ,'parent_show' => $manageCommonQuestions->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createCommonQuestions =  Permission::create(['name'  => 'create_common_questions'    , 'display_name'    => 'إنشاء سؤال جديد'       , 'route' => 'common_questions/create'         , 'module' => 'common_questions' , 'as' => 'common_questions.create'   , 'icon' => null              , 'parent' => $manageCommonQuestions->id , 'parent_original' => $manageCommonQuestions->id ,'parent_show' => $manageCommonQuestions->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayCommonQuestions =  Permission::create(['name' => 'display_common_questions'  , 'display_name'     => 'عرض سؤال'         , 'route' => 'common_questions/{common_questions}'       , 'module' => 'common_questions' , 'as' => 'common_questions.show'     , 'icon' => null              , 'parent' => $manageCommonQuestions->id , 'parent_original' => $manageCommonQuestions->id ,'parent_show' => $manageCommonQuestions->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateCommonQuestions  =  Permission::create(['name' => 'update_common_questions'   , 'display_name'     => 'تحديث سؤال'       , 'route' => 'common_questions/{common_questions}/edit'  , 'module' => 'common_questions' , 'as' => 'common_questions.edit'     , 'icon' => null              , 'parent' => $manageCommonQuestions->id , 'parent_original' => $manageCommonQuestions->id ,'parent_show' => $manageCommonQuestions->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteCommonQuestions =  Permission::create(['name'  => 'delete_common_questions'    , 'display_name'    => 'حذف سؤال'       , 'route' => 'common_questions/{common_questions}'       , 'module' => 'common_questions' , 'as' => 'common_questions.destroy'  , 'icon' => null              , 'parent' => $manageCommonQuestions->id , 'parent_original' => $manageCommonQuestions->id ,'parent_show' => $manageCommonQuestions->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //Common Questions
        $manageNews = Permission::create(['name' => 'manage_news', 'display_name' => 'إدارة الاخبار'         , 'route' => 'news' , 'module' => 'news' , 'as' => 'news.index' , 'icon' => 'fas fa-newspaper'            , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '105',] );
        $manageNews->parent_show = $manageNews->id; $manageNews->save();
        $showNews   =  Permission::create(['name'  => 'show_news'      , 'display_name'    => 'الاخبار'             , 'route' => 'news'                , 'module' => 'news' , 'as' => 'news.index'    , 'icon' => 'fas fa-newspaper'     , 'parent' => $manageNews->id , 'parent_original' => $manageNews->id ,'parent_show' => $manageNews->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createNews =  Permission::create(['name'  => 'create_news'    , 'display_name'    => 'إنشاء خبر جديد'       , 'route' => 'news/create'         , 'module' => 'news' , 'as' => 'news.create'   , 'icon' => null              , 'parent' => $manageNews->id , 'parent_original' => $manageNews->id ,'parent_show' => $manageNews->id , 'sidebar_link' => '1' , 'appear' => '0'] );
        $displayNews =  Permission::create(['name' => 'display_news'  , 'display_name'     => 'عرض خبر'         , 'route' => 'news/{news}'       , 'module' => 'news' , 'as' => 'news.show'     , 'icon' => null              , 'parent' => $manageNews->id , 'parent_original' => $manageNews->id ,'parent_show' => $manageNews->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateNews  =  Permission::create(['name' => 'update_news'   , 'display_name'     => 'تحديث خبر'       , 'route' => 'news/{news}/edit'  , 'module' => 'news' , 'as' => 'news.edit'     , 'icon' => null              , 'parent' => $manageNews->id , 'parent_original' => $manageNews->id ,'parent_show' => $manageNews->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteNews =  Permission::create(['name'  => 'delete_news'    , 'display_name'    => 'حذف خبر'       , 'route' => 'news/{news}'       , 'module' => 'news' , 'as' => 'news.destroy'  , 'icon' => null              , 'parent' => $manageNews->id , 'parent_original' => $manageNews->id ,'parent_show' => $manageNews->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //payment Categories
        $managePaymentCategories = Permission::create(['name' => 'manage_payment_categories', 'display_name' => 'إدارة تصنيف طرق الدفع' , 'route' => 'payment_categories' , 'module' => 'payment_categories' , 'as' => 'payment_categories.index' , 'icon' => 'fas fa-file-archive' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '110',] );
        $managePaymentCategories->parent_show = $managePaymentCategories->id; $managePaymentCategories->save();
        $showPaymentCategories    =  Permission::create(['name' => 'show_payment_categories'    ,  'display_name' => 'تصنيف طرق الدفع'      , 'route' => 'payment_categories' , 'module' => 'payment_categories' , 'as' => 'payment_categories.index'    , 'icon' => 'fas fa-file-archive' , 'parent' => $managePaymentCategories->id , 'parent_original' => $managePaymentCategories->id ,'parent_show' => $managePaymentCategories->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createPaymentCategories  =  Permission::create(['name' => 'create_payment_categories'  , 'display_name'  => 'إضافة تصنيف' , 'route' => 'payment_categories' , 'module' => 'payment_categories' , 'as' => 'payment_categories.create'   , 'icon' => null                  , 'parent' => $managePaymentCategories->id , 'parent_original' => $managePaymentCategories->id ,'parent_show' => $managePaymentCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $displayPaymentCategories =  Permission::create(['name' => 'display_payment_categories' , 'display_name'  => 'عرض تصنيف'   , 'route' => 'payment_categories' , 'module' => 'payment_categories' , 'as' => 'payment_categories.show'     , 'icon' => null                  , 'parent' => $managePaymentCategories->id , 'parent_original' => $managePaymentCategories->id ,'parent_show' => $managePaymentCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updatePaymentCategories  =  Permission::create(['name' => 'update_payment_categories'  , 'display_name'  => 'تعديل تصنيف' , 'route' => 'payment_categories' , 'module' => 'payment_categories' , 'as' => 'payment_categories.edit'     , 'icon' => null                  , 'parent' => $managePaymentCategories->id , 'parent_original' => $managePaymentCategories->id ,'parent_show' => $managePaymentCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deletePaymentCategories  =  Permission::create(['name' => 'delete_payment_categories'  , 'display_name'  => 'حذف تصنيف' , 'route' => 'payment_categories' , 'module' => 'payment_categories' , 'as' => 'payment_categories.destroy'  , 'icon' => null                  , 'parent' => $managePaymentCategories->id , 'parent_original' => $managePaymentCategories->id ,'parent_show' => $managePaymentCategories->id , 'sidebar_link' => '0' , 'appear' => '0'] );

        //payment methodOffline
        $managePaymentMethodOfflines = Permission::create(['name' => 'manage_payment_method_offlines', 'display_name' => '  طرق الدفع' , 'route' => 'payment_method_offlines' , 'module' => 'payment_method_offlines' , 'as' => 'payment_method_offlines.index' , 'icon' => 'fa fa-list-ul' , 'parent' => $managePaymentCategories->id , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '115',] );
        $managePaymentMethodOfflines->parent_show = $managePaymentMethodOfflines->id; $managePaymentMethodOfflines->save();
        $showPaymentMethodOfflines    =  Permission::create(['name' => 'show_payment_method_offlines'    ,  'display_name' => ' طرق الدفع'      , 'route' => 'payment_method_offlines' , 'module' => 'payment_method_offlines' , 'as' => 'payment_method_offlines.index'    , 'icon' => 'fa fa-list-ul' , 'parent' => $managePaymentMethodOfflines->id , 'parent_original' => $managePaymentMethodOfflines->id ,'parent_show' => $managePaymentMethodOfflines->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createPaymentMethodOfflines  =  Permission::create(['name' => 'create_payment_method_offlines'  , 'display_name'  => 'إضافة طريقة دفع جديدة' , 'route' => 'payment_method_offlines' , 'module' => 'payment_method_offlines' , 'as' => 'payment_method_offlines.create'   , 'icon' => null                  , 'parent' => $managePaymentMethodOfflines->id , 'parent_original' => $managePaymentMethodOfflines->id ,'parent_show' => $managePaymentMethodOfflines->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $displayPaymentMethodOfflines =  Permission::create(['name' => 'display_payment_method_offlines' , 'display_name'  => 'عرض طريقة دفع'   , 'route' => 'payment_method_offlines' , 'module' => 'payment_method_offlines' , 'as' => 'payment_method_offlines.show'     , 'icon' => null                  , 'parent' => $managePaymentMethodOfflines->id , 'parent_original' => $managePaymentMethodOfflines->id ,'parent_show' => $managePaymentMethodOfflines->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updatePaymentMethodOfflines  =  Permission::create(['name' => 'update_payment_method_offlines'  , 'display_name'  => 'تعديل طريقة الدفع' , 'route' => 'payment_method_offlines' , 'module' => 'payment_method_offlines' , 'as' => 'payment_method_offlines.edit'     , 'icon' => null                  , 'parent' => $managePaymentMethodOfflines->id , 'parent_original' => $managePaymentMethodOfflines->id ,'parent_show' => $managePaymentMethodOfflines->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deletePaymentMethodOfflines  =  Permission::create(['name' => 'delete_payment_method_offlines'  , 'display_name'  => 'حذف طريقة الدفع' , 'route' => 'payment_method_offlines' , 'module' => 'payment_method_offlines' , 'as' => 'payment_method_offlines.destroy'  , 'icon' => null                  , 'parent' => $managePaymentMethodOfflines->id , 'parent_original' => $managePaymentMethodOfflines->id ,'parent_show' => $managePaymentMethodOfflines->id , 'sidebar_link' => '0' , 'appear' => '0'] );


        //Site Settings
        $manageSiteSettings = Permission::create(['name' => 'manage_site_settings', 'display_name' => 'الاعدادات العامة' , 'route' => 'site_settings' , 'module' => 'site_settings' , 'as' => 'site_settings.index' , 'icon' => 'fa fa-cog' , 'parent' => '0' , 'parent_original' => '0' , 'sidebar_link' => '1' , 'appear' => '1' , 'ordering' => '120',] );
        $manageSiteSettings->parent_show = $manageSiteSettings->id; $manageSiteSettings->save();

        $showSiteSettings    =  Permission::create(['name' => 'show_site_settings'    ,  'display_name' => 'الاعدادات العامة'      , 'route' => 'site_settings' , 'module' => 'site_settings' , 'as' => 'site_settings.index'    , 'icon' => 'fa fa-cog' , 'parent' => $manageSiteSettings->id , 'parent_original' => $manageSiteSettings->id ,'parent_show' => $manageSiteSettings->id , 'sidebar_link' => '1' , 'appear' => '1'] );
        $createSiteSettings  =  Permission::create(['name' => 'create_site_settings'  , 'display_name'  => 'إضافة تصنيف' , 'route' => 'site_settings' , 'module' => 'site_settings' , 'as' => 'site_settings.create'   , 'icon' => null                  , 'parent' => $manageSiteSettings->id , 'parent_original' => $manageSiteSettings->id ,'parent_show' => $manageSiteSettings->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $displaySiteSettings =  Permission::create(['name' => 'display_site_settings' , 'display_name'  => 'عرض تصنيف'   , 'route' => 'site_settings' , 'module' => 'site_settings' , 'as' => 'site_settings.show'     , 'icon' => null                  , 'parent' => $manageSiteSettings->id , 'parent_original' => $manageSiteSettings->id ,'parent_show' => $manageSiteSettings->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $updateSiteSettings  =  Permission::create(['name' => 'update_site_settings'  , 'display_name'  => 'تعديل تصنيف' , 'route' => 'site_settings' , 'module' => 'site_settings' , 'as' => 'site_settings.edit'     , 'icon' => null                  , 'parent' => $manageSiteSettings->id , 'parent_original' => $manageSiteSettings->id ,'parent_show' => $manageSiteSettings->id , 'sidebar_link' => '0' , 'appear' => '0'] );
        $deleteSiteSettings  =  Permission::create(['name' => 'delete_site_settings'  , 'display_name'  => 'حذف تصنيف' , 'route' => 'site_settings' , 'module' => 'site_settings' , 'as' => 'site_settings.destroy'  , 'icon' => null                  , 'parent' => $manageSiteSettings->id , 'parent_original' => $manageSiteSettings->id ,'parent_show' => $manageSiteSettings->id , 'sidebar_link' => '0' , 'appear' => '0'] );


        
    }
}
