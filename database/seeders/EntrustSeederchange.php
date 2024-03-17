<?php

//web menus Categories

use App\Models\Permission;


//Support menu

//specialization
$manageSpecializations = Permission::create(['name' => 'manage_specializations', 'display_name' => ['ar'    =>  'التخصصات',    'en'    =>  'specializations'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.index', 'icon' => 'fas fa-user', 'parent' => $manageCustomers->id, 'parent_original' => '0', 'parent_show' => $manageCustomers->id, 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '55',]);
$manageSpecializations->parent_show = $manageSpecializations->id;
$manageSpecializations->save();
$showSpecializations   =  Permission::create(['name' => 'show_specializations', 'display_name'    =>  ['ar'   =>  'التخصصات',   'en'    =>  'specializations'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.index', 'icon' => 'fas fa-user', 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '1', 'appear' => '1']);
$createSpecializations =  Permission::create(['name' => 'create_specializations', 'display_name'    =>  ['ar'   =>  'إضافة تخصص جديد',   'en'    =>  'Add specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.create', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '1', 'appear' => '0']);
$displaySpecializations =  Permission::create(['name' => 'display_specializations', 'display_name'    =>  ['ar'   =>  'عرض تخصص',   'en'    =>  'Dsiplay specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.show', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateSpecializations  =  Permission::create(['name' => 'update_specializations', 'display_name'    =>  ['ar'   =>  'تعديل تخصص',   'en'    =>  'Edit specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.edit', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteSpecializations =  Permission::create(['name' => 'delete_specializations', 'display_name'    =>  ['ar'   =>  'حذف تخصص',   'en'    =>  'Delete specialization'], 'route' => 'specializations', 'module' => 'specializations', 'as' => 'specializations.destroy', 'icon' => null, 'parent' => $manageSpecializations->id, 'parent_original' => $manageSpecializations->id, 'parent_show' => $manageSpecializations->id, 'sidebar_link' => '0', 'appear' => '0']);
