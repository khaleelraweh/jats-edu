<?php

namespace Database\Seeders;

use App\Models\Permission;

// Sponsers
$manageSponsers = Permission::create(['name' => 'manage_sponsers', 'display_name' => ['ar'  =>  'إدارة الجهات التعليمية',    'en'    =>  'Manage Sponsers'], 'route' => 'sponsers', 'module' => 'sponsers', 'as' => 'sponsers.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
$manageSponsers->parent_show = $manageSponsers->id;
$manageSponsers->save();
$showSponsers      =  Permission::create(['name'  => 'show_sponsers', 'display_name'       =>  ['ar'   =>  'الجهات التعليمية',               'en'    =>  'Sponsers'], 'route' => 'sponsers', 'module' => 'sponsers', 'as' => 'sponsers.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageSponsers->id, 'parent_original' => $manageSponsers->id, 'parent_show' => $manageSponsers->id, 'sidebar_link' => '1', 'appear' => '1']);
$createSponsers    =  Permission::create(['name'  => 'create_sponsers', 'display_name'     =>  ['ar'   =>  'إنشاء جهة تعليمية',           'en'    =>  'Create new Sponsers'], 'route' => 'sponsers', 'module' => 'sponsers', 'as' => 'sponsers.create', 'icon' => null, 'parent' => $manageSponsers->id, 'parent_original' => $manageSponsers->id, 'parent_show' => $manageSponsers->id, 'sidebar_link' => '1', 'appear' => '0']);
$displaySponsers   =  Permission::create(['name' => 'display_sponsers', 'display_name'    =>  ['ar'   =>  'عرض جهة تعليمية',              'en'    =>  'Display Sponser'], 'route' => 'sponsers', 'module' => 'sponsers', 'as' => 'sponsers.show', 'icon' => null, 'parent' => $manage->id, 'parent_original' => $manageSponsers->id, 'parent_show' => $manageSponsers->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateSponsers    =  Permission::create(['name' => 'update_sponsers', 'display_name'     =>  ['ar'   =>  'تعديل جهة تعليمية',            'en'    =>  'Edit Sponser'], 'route' => 'sponsers', 'module' => 'sponsers', 'as' => 'sponsers.edit', 'icon' => null, 'parent' => $manageSponsers->id, 'parent_original' => $manageSponsers->id, 'parent_show' => $manageSponsers->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteSponsers    =  Permission::create(['name'  => 'delete_sponsers', 'display_name'     =>  ['ar'   =>  'حذف جهة تعليمية',              'en'    =>  'Delete Sponser'], 'route' => 'sponsers', 'module' => 'sponsers', 'as' => 'sponsers.destroy', 'icon' => null, 'parent' => $manageSponsers->id, 'parent_original' => $manageSponsers->id, 'parent_show' => $manageSponsers->id, 'sidebar_link' => '0', 'appear' => '0']);
