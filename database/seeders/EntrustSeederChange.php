<?php

namespace Database\Seeders;

use App\Models\Permission;

//pages 
$managePages = Permission::create(['name' => 'manage_pages', 'display_name' => ['ar' => 'إدارة الصفحات', 'en' => 'Manage Pages'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.index', 'icon' => 'fa fa-list-ul', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '5',]);
$managePages->parent_show = $managePages->id;
$managePages->save();
$showPages    =  Permission::create(['name' => 'show_pages',  'display_name' => ['ar'     => 'إدارة الصفحة ', 'en'  =>   'Main Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.index', 'icon' => 'fas fa-bars', 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '1', 'appear' => '1']);
$createPages  =  Permission::create(['name' => 'create_pages', 'display_name'  => ['ar'     => 'إضافة صفحة', 'en'  =>  'Add Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.create', 'icon' => null, 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '0', 'appear' => '0']);
$displayPages =  Permission::create(['name' => 'display_pages', 'display_name'  => ['ar'     => 'عرض صفحة', 'en'  =>  'Display Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.show', 'icon' => null, 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '0', 'appear' => '0']);
$updatePages  =  Permission::create(['name' => 'update_pages', 'display_name'  => ['ar'     => 'تعديل صفحة', 'en'  =>  'Edit Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.edit', 'icon' => null, 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '0', 'appear' => '0']);
$deletePages  =  Permission::create(['name' => 'delete_pages', 'display_name'  => ['ar'     => 'حذف صفحة', 'en'  =>  'Delete Page'], 'route' => 'pages', 'module' => 'pages', 'as' => 'pages.destroy', 'icon' => null, 'parent' => $managePages->id, 'parent_original' => $managePages->id, 'parent_show' => $managePages->id, 'sidebar_link' => '0', 'appear' => '0']);
