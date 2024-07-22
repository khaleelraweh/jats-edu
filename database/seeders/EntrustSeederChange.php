<?php

namespace Database\Seeders;

use App\Models\Permission;

// TeachRequests
$manageTeachRequests = Permission::create(['name' => 'manage_teach_requests', 'display_name' => ['ar'  =>  'إدارة طلبات التدريب',    'en'    =>  'Manage Teach Requests'], 'route' => 'teach_request', 'module' => 'teach_request', 'as' => 'teach_request.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
$manageTeachRequests->parent_show = $manageTeachRequests->id;
$manageTeachRequests->save();
$showTeachRequests   =  Permission::create(['name'  => 'show_teach_requests', 'display_name'       =>  ['ar'   =>  'طلبات التدريس',   'en'    =>  'Teach Requests'], 'route' => 'teach_request', 'module' => 'teach_request', 'as' => 'teach_request.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '1', 'appear' => '1']);
$createTeachRequests =  Permission::create(['name'  => 'create_teach_requests', 'display_name'     =>  ['ar'   =>  'إنشاء طلب تدريس',   'en'    =>  'Create Teach Request'], 'route' => 'teach_request', 'module' => 'teach_request', 'as' => 'teach_request.create', 'icon' => null, 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayTeachRequests =  Permission::create(['name' => 'display_teach_requests', 'display_name'    =>  ['ar'   =>  'عرض طلب تدريس',   'en'    =>  'Display Teach Request'], 'route' => 'teach_request', 'module' => 'teach_request', 'as' => 'teach_request.show', 'icon' => null, 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateTeachRequests  =  Permission::create(['name' => 'update_teach_requests', 'display_name'     =>  ['ar'   =>  'تعديل طلب تدريس',   'en'    =>  'Edit Teach Request'], 'route' => 'teach_request', 'module' => 'teach_request', 'as' => 'teach_request.edit', 'icon' => null, 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteTeachRequests =  Permission::create(['name'  => 'delete_teach_requests', 'display_name'     =>  ['ar'   =>  'حذف طلب تدريس',   'en'    =>  'Delete Teach Request'], 'route' => 'teach_request', 'module' => 'teach_request', 'as' => 'teach_request.destroy', 'icon' => null, 'parent' => $manageTeachRequests->id, 'parent_original' => $manageTeachRequests->id, 'parent_show' => $manageTeachRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
