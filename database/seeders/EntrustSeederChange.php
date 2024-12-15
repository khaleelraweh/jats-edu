<?php

namespace Database\Seeders;

use App\Models\Permission;

// page visits
$manageInstPageVisit = Permission::create(['name' => 'manage_inst_page_visit', 'display_name' => ['ar'  =>  'إدارة الزيارات',    'en'    =>  'Manage Page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
$manageInstPageVisit->parent_show = $manageInstPageVisit->id;
$manageInstPageVisit->save();
$showInstPageVisit      =  Permission::create(['name'  => 'show_inst_page_visit', 'display_name'       =>  ['ar'   =>  'الزيارات',               'en'    =>  'Page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '1', 'appear' => '1']);
$createInstPageVisit    =  Permission::create(['name'  => 'create_inst_page_visit', 'display_name'     =>  ['ar'   =>  'إنشاء زيارة',           'en'    =>  'Create new Page Visti'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.create', 'icon' => null, 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayInstPageVisit   =  Permission::create(['name' => 'display_inst_page_visit', 'display_name'    =>  ['ar'   =>  'عرض زيارة',              'en'    =>  'Display Page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.show', 'icon' => null, 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateInstPageVisit    =  Permission::create(['name' => 'update_inst_page_visit', 'display_name'     =>  ['ar'   =>  'تعديل زيارة',            'en'    =>  'Edit Page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.edit', 'icon' => null, 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteInstPageVisit    =  Permission::create(['name'  => 'delete_inst_page_visit', 'display_name'     =>  ['ar'   =>  'حذف زيارة',              'en'    =>  'Delete page Visit'], 'route' => 'inst_page_visits', 'module' => 'inst_page_visits', 'as' => 'inst_page_visits.destroy', 'icon' => null, 'parent' => $manageInstPageVisit->id, 'parent_original' => $manageInstPageVisit->id, 'parent_show' => $manageInstPageVisit->id, 'sidebar_link' => '0', 'appear' => '0']);
