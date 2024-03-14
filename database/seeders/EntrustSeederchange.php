<?php

//web menus Categories

use App\Models\Permission;


//Support menu
//lecturers
$manageLecturers = Permission::create(['name' => 'manage_lecturers', 'display_name' => ['ar'    =>  'المحاضرين',    'en'    =>  'lecturers'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.index', 'icon' => 'fas fa-user', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '60',]);
$manageLecturers->parent_show = $manageLecturers->id;
$manageLecturers->save();
$showlecturers   =  Permission::create(['name' => 'show_lecturers', 'display_name'    =>  ['ar'   =>  'المحاضرين',   'en'    =>  'lecturers'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.index', 'icon' => 'fas fa-user', 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '1', 'appear' => '1']);
$createlecturers =  Permission::create(['name' => 'create_lecturers', 'display_name'    =>  ['ar'   =>  'إضافة محاضر جديد',   'en'    =>  'Add lecturer'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.create', 'icon' => null, 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '1', 'appear' => '0']);
$displaylecturers =  Permission::create(['name' => 'display_lecturers', 'display_name'    =>  ['ar'   =>  'عرض محاضر',   'en'    =>  'Dsiplay lecturer'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.show', 'icon' => null, 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '0', 'appear' => '0']);
$updatelecturers  =  Permission::create(['name' => 'update_lecturers', 'display_name'    =>  ['ar'   =>  'تعديل محاضر',   'en'    =>  'Edit lecturer'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.edit', 'icon' => null, 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '0', 'appear' => '0']);
$deletelecturers =  Permission::create(['name' => 'delete_lecturers', 'display_name'    =>  ['ar'   =>  'حذف محاضر',   'en'    =>  'Delete lecturer'], 'route' => 'lecturers', 'module' => 'lecturers', 'as' => 'lecturers.destroy', 'icon' => null, 'parent' => $manageLecturers->id, 'parent_original' => $manageLecturers->id, 'parent_show' => $manageLecturers->id, 'sidebar_link' => '0', 'appear' => '0']);
