<?php

namespace Database\Seeders;

use App\Models\Permission;

// CompanyRequests
$manageCompanyRequests = Permission::create(['name' => 'manage_company_requests', 'display_name' => ['ar'  =>  'إدارة طلبات الشركات',    'en'    =>  'Manage Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
$manageCompanyRequests->parent_show = $manageCompanyRequests->id;
$manageCompanyRequests->save();
$showCompanyRequests   =  Permission::create(['name'  => 'show_company_requests', 'display_name'       =>  ['ar'   =>  'طلبات الشركات',             'en'    =>  'Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '1', 'appear' => '1']);
$createCompanyRequests =  Permission::create(['name'  => 'create_company_requests', 'display_name'     =>  ['ar'   =>  'إنشاء طلب شركة جديد',       'en'    =>  'Create new Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.create', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayCompanyRequests =  Permission::create(['name' => 'display_company_requests', 'display_name'    =>  ['ar'   =>  'عرض طلب شركة',              'en'    =>  'Display Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.show', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateCompanyRequests  =  Permission::create(['name' => 'update_company_requests', 'display_name'     =>  ['ar'   =>  'تعديل طلب شركة',            'en'    =>  'Edit Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.edit', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteCompanyRequests =  Permission::create(['name'  => 'delete_company_requests', 'display_name'     =>  ['ar'   =>  'حذف طلب شركة',              'en'    =>  'Delete Company Request'], 'route' => 'company_requests', 'module' => 'company_requests', 'as' => 'company_requests.destroy', 'icon' => null, 'parent' => $manageCompanyRequests->id, 'parent_original' => $manageCompanyRequests->id, 'parent_show' => $manageCompanyRequests->id, 'sidebar_link' => '0', 'appear' => '0']);
