<?php

namespace Database\Seeders;

use App\Models\Permission;

// CompanyRequests
$manageCompanyRequests = Permission::create(['name' => 'manage_company_requests', 'display_name' => ['ar'  =>  'شركائنا',    'en'    =>  'Our Partners'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
$manageCompanyRequests->parent_show = $manageCompanyRequests->id;
$manageCompanyRequests->save();
$showCompanyRequests   =  Permission::create(['name'  => 'show_company_requests', 'display_name'       =>  ['ar'   =>  'شركائنا',   'en'    =>  'Our Partners'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '1', 'appear' => '1']);
$createCompanyRequests =  Permission::create(['name'  => 'create_company_requests', 'display_name'     =>  ['ar'   =>  'إنشاء شريك',   'en'    =>  'Create Our Partner'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.create', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayCompanyRequests =  Permission::create(['name' => 'display_company_requests', 'display_name'    =>  ['ar'   =>  'عرض شريك',   'en'    =>  'Display Our Partner'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.show', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateCompanyRequests  =  Permission::create(['name' => 'update_company_requests', 'display_name'     =>  ['ar'   =>  'تعديل شريك',   'en'    =>  'Edit Our Partner'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.edit', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteCompanyRequests =  Permission::create(['name'  => 'delete_company_requests', 'display_name'     =>  ['ar'   =>  'حذف شريك',   'en'    =>  'Delete Our Partner'], 'route' => 'partner', 'module' => 'partner', 'as' => 'partner.destroy', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
