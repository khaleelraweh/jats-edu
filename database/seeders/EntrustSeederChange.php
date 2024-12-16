<?php

namespace Database\Seeders;

use App\Models\Permission;

// Certificates
$manageCertificates = Permission::create(['name' => 'manage_certificates', 'display_name' => ['ar'  =>  'إدارة الشهائد ',    'en'    =>  'Manage Certificates'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.index', 'icon' => 'fas fas fa-newspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '50',]);
$manageCertificates->parent_show = $manageCertificates->id;
$manageCertificates->save();
$showCertificates      =  Permission::create(['name'  => 'show_certificates', 'display_name'       =>  ['ar'   =>  'الشهائد',               'en'    =>  'Certificates'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.index', 'icon' => 'fas fas fa-newspaper', 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '1', 'appear' => '1']);
$createCertificates    =  Permission::create(['name'  => 'create_certificates', 'display_name'     =>  ['ar'   =>  'إنشاء شهادة',           'en'    =>  'Create new Certificate'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.create', 'icon' => null, 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayCertificates   =  Permission::create(['name' => 'display_certificates', 'display_name'    =>  ['ar'   =>  'عرض شهادة',              'en'    =>  'Display Certificate'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.show', 'icon' => null, 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateCertificates    =  Permission::create(['name' => 'update_certificates', 'display_name'     =>  ['ar'   =>  'تعديل شهادة',            'en'    =>  'Edit Certificate'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.edit', 'icon' => null, 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteCertificates    =  Permission::create(['name'  => 'delete_certificates', 'display_name'     =>  ['ar'   =>  'حذف شهادة',              'en'    =>  'Delete Certificate'], 'route' => 'certificates', 'module' => 'certificates', 'as' => 'certificates.destroy', 'icon' => null, 'parent' => $manageCertificates->id, 'parent_original' => $manageCertificates->id, 'parent_show' => $manageCertificates->id, 'sidebar_link' => '0', 'appear' => '0']);
