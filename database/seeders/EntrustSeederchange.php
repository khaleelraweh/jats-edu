<?php

//web menus Categories

use App\Models\Permission;


//Support menu
//Instructors
$manageInstructors = Permission::create(['name' => 'manage_instructors', 'display_name' => ['ar'    =>  'إدارة المحاضرين', 'en' =>  'Manage Instructors'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.index', 'icon' => 'fas fa-sliders-h', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '15',]);
$manageInstructors->parent_show = $manageInstructors->id;
$manageInstructors->save();
$showInstructors    =  Permission::create(['name' => 'show_instructors', 'display_name'    =>  ['ar'    =>  ' عارض  المحاضرين',   'en'    =>  'Main Instructors'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.index', 'icon' => 'fas  fa-sliders-h', 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '1', 'appear' => '1']);
$createInstructors  =  Permission::create(['name' => 'create_instructors', 'display_name'    =>  ['ar'    =>  'إضافة محاضر جديد',   'en'    =>  'Add Instructor'], 'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.create', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);
$displayInstructors =  Permission::create(['name' => 'display_instructors', 'display_name'    =>  ['ar'    =>  'عرض محاضر',   'en'    =>  'Display Main Instructor'],  'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.show', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateInstructors  =  Permission::create(['name' => 'update_instructors', 'display_name'    =>  ['ar'    =>  'تعديل محاضر',   'en'    =>  'Edit Main Instructor'],  'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.edit', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteInstructors  =  Permission::create(['name' => 'delete_instructors', 'display_name'    =>  ['ar'    =>  'حذف محاضر',   'en'    =>  'Delete Main Instructor'],  'route' => 'instructors', 'module' => 'instructors', 'as' => 'instructors.destroy', 'icon' => null, 'parent' => $manageInstructors->id, 'parent_original' => $manageInstructors->id, 'parent_show' => $manageInstructors->id, 'sidebar_link' => '0', 'appear' => '0']);
