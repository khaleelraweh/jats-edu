<?php

namespace Database\Seeders;

use App\Models\Permission;

//Manage call_actions 
$manageCallActions = Permission::create(['name' => 'manage_call_actions', 'display_name' => ['ar'    =>  'إجراءات الاتصال', 'en'    =>  'Call Actions'], 'route' => 'call_actions', 'module' => 'call_actions', 'as' => 'call_actions.index', 'icon' => 'far fa-calendar-alt', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '40',]);
$manageCallActions->parent_show = $manageCallActions->id;
$manageCallActions->save();
$showCallActions   =  Permission::create(['name' => 'show_call_actions',   'display_name'    =>  ['ar'   =>  'عرض إجراءات الاتصال',   'en'       =>  'Call Actions'],   'route'     => 'call_actions', 'module'   => 'call_actions', 'as' =>  'call_actions.index', 'icon' => 'far fa-calendar-alt', 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '1', 'appear' => '1']);
$createCallActions =  Permission::create(['name' => 'create_call_actions',   'display_name'    =>  ['ar'   =>  'إضافة إجراء الاتصال جديدة',   'en'    =>  'Add new Call Action'],   'route'     => 'call_actions', 'module'  => 'call_actions', 'as' =>   'call_actions.create', 'icon' => null, 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayCallActions =  Permission::create(['name' => 'display_call_actions',   'display_name'    =>  ['ar'   =>  'عرض إجراء الاتصال',   'en'          =>  'Display Call Action'],   'route'     => 'call_actions',  'module'  => 'call_actions', 'as' =>  'call_actions.show', 'icon' => null, 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateCallActions =  Permission::create(['name' => 'update_call_actions',   'display_name'    =>  ['ar'   =>  'تعديل إجراء الاتصال',   'en'       =>  'Edit Call Action'],   'route'     => 'call_actions', 'module'   => 'call_actions', 'as' =>  'call_actions.edit', 'icon' => null, 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteCallActions =  Permission::create(['name' => 'delete_call_actions',   'display_name'    =>  ['ar'   =>  'حذف إجراء الاتصال',   'en'         =>  'Delete Call Action'],   'route'     => 'call_actions', 'module'   => 'call_actions', 'as' =>  'call_actions.destroy', 'icon' => null, 'parent' => $manageCallActions->id, 'parent_original' => $manageCallActions->id, 'parent_show' => $manageCallActions->id, 'sidebar_link' => '0', 'appear' => '0']);
