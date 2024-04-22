<?php

//web menus Categories

use App\Models\Permission;


//Support menu


//Manage events 
$manageEvents = Permission::create(['name' => 'manage_events', 'display_name' => ['ar'    =>  'الاحداث', 'en'    =>  'Events'], 'route' => 'events', 'module' => 'events', 'as' => 'events.index', 'icon' => 'fas fa-book-open', 'parent' => $manageCourseCategories->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '40',]);
$manageEvents->parent_show = $manageEvents->id;
$manageEvents->save();
$showEvents   =  Permission::create(['name' => 'show_events',   'display_name'    =>  ['ar'   =>  'عرض الاحداث',   'en'       =>  'Events'],   'route'     => 'events', 'module'   => 'events', 'as' =>  'events.index', 'icon' => 'fas fa-align-justify', 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '1', 'appear' => '1']);
$createEvents =  Permission::create(['name' => 'create_events',   'display_name'    =>  ['ar'   =>  'إضافة حدث جديدة',   'en'    =>  'Add new Event'],   'route'     => 'events', 'module'  => 'events', 'as' =>   'events.create', 'icon' => null, 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayEvents =  Permission::create(['name' => 'display_events',   'display_name'    =>  ['ar'   =>  'عرض حدث',   'en'          =>  'Display Event'],   'route'     => 'events',  'module'  => 'events', 'as' =>  'events.show', 'icon' => null, 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateEvents =  Permission::create(['name' => 'update_events',   'display_name'    =>  ['ar'   =>  'تعديل حدث',   'en'       =>  'Edit Event'],   'route'     => 'events', 'module'   => 'events', 'as' =>  'events.edit', 'icon' => null, 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteEvents =  Permission::create(['name' => 'delete_events',   'display_name'    =>  ['ar'   =>  'حذف حدث',   'en'         =>  'Delete Event'],   'route'     => 'events', 'module'   => 'events', 'as' =>  'events.destroy', 'icon' => null, 'parent' => $manageEvents->id, 'parent_original' => $manageEvents->id, 'parent_show' => $manageEvents->id, 'sidebar_link' => '0', 'appear' => '0']);
