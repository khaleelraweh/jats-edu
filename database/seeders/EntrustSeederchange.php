<?php

//web menus Categories

use App\Models\Permission;


//Support menu
$manageSupportMenus = Permission::create(['name' => 'manage_support_menus', 'display_name' => ['ar'    =>  'إدارة قائمة الدعم', 'en'   =>  'Support Menu'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '10',]);
$manageSupportMenus->parent_show = $manageSupportMenus->id;
$manageSupportMenus->save();
$showSupportMenus    =  Permission::create(['name' => 'show_support_menus',  'display_name' => ['ar'  =>  'إدارة قائمة الدعم',   'en'    =>  'Support Menu'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
$createSupportMenus  =  Permission::create(['name' => 'create_support_menus', 'display_name'  => ['ar'  =>  'إضافة رابط',   'en'    =>  'Add menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.create', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
$displaySupportMenus =  Permission::create(['name' => 'display_support_menus', 'display_name'  => ['ar'  =>  'عرض رابط',   'en'    =>  'Display menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.show', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateSupportMenus  =  Permission::create(['name' => 'update_support_menus', 'display_name'  => ['ar'  =>  'تعديل رابط',   'en'    =>  'Edit menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.edit', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteSupportMenus  =  Permission::create(['name' => 'delete_support_menus', 'display_name'  => ['ar'  =>  'حذف رابط',   'en'    =>  'Delete menu Link'], 'route' => 'support_menus', 'module' => 'support_menus', 'as' => 'support_menus.destroy', 'icon' => null, 'parent' => $manageSupportMenus->id, 'parent_original' => $manageSupportMenus->id, 'parent_show' => $manageSupportMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
