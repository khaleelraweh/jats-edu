<?php

namespace Database\Seeders;

use App\Models\Permission;

// Partners
$managePartners = Permission::create(['name' => 'manage_partners', 'display_name' => ['ar'  =>  'شركائنا',    'en'    =>  'Our Partners'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
$managePartners->parent_show = $managePartners->id;
$managePartners->save();
$showPartners   =  Permission::create(['name'  => 'show_partners', 'display_name'       =>  ['ar'   =>  'شركائنا',   'en'    =>  'Our Partners'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '1', 'appear' => '1']);
$createPartners =  Permission::create(['name'  => 'create_partners', 'display_name'     =>  ['ar'   =>  'إنشاء شريك',   'en'    =>  'Create Our Partner'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.create', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayPartners =  Permission::create(['name' => 'display_partners', 'display_name'    =>  ['ar'   =>  'عرض شريك',   'en'    =>  'Display Our Partner'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.show', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);
$updatePartners  =  Permission::create(['name' => 'update_partners', 'display_name'     =>  ['ar'   =>  'تعديل شريك',   'en'    =>  'Edit Our Partner'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.edit', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);
$deletePartners =  Permission::create(['name'  => 'delete_partners', 'display_name'     =>  ['ar'   =>  'حذف شريك',   'en'    =>  'Delete Our Partner'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.destroy', 'icon' => null, 'parent' => $managePartners->id, 'parent_original' => $managePartners->id, 'parent_show' => $managePartners->id, 'sidebar_link' => '0', 'appear' => '0']);
