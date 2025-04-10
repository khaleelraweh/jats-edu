<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddPolicyPrivacyMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          //Policies and privacy menu
          $managePolicyPrivacyMenus = Permission::create(['name' => 'manage_policy_privacy_menus', 'display_name' => ['ar'    =>  'إدارة قائمة السياسات', 'en'   =>  'Policy Privacy Menu'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.index', 'icon' => 'fas fa-bars', 'parent' => $manageWebMenus->id, 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '105',]);
          $managePolicyPrivacyMenus->parent_show = $managePolicyPrivacyMenus->id;
          $managePolicyPrivacyMenus->save();
          $showPolicyPrivacy    =  Permission::create(['name' => 'show_policy_privacy_menus',  'display_name' => ['ar'  =>  'إدارة قائمة السياسات',   'en'    =>  'Policy Privacy Menu'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.index', 'icon' => 'fas fa-bars', 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '1', 'appear' => '1']);
          $createPolicyPrivacy  =  Permission::create(['name' => 'create_policy_privacy_menus', 'display_name'  => ['ar'  =>  'إضافة قامة السياسات',   'en'    =>  'Add Policy Privacy Menu Link'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.create', 'icon' => null, 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
          $displayPolicyPrivacy =  Permission::create(['name' => 'display_policy_privacy_menus', 'display_name'  => ['ar'  =>  'عرض قامة السياسات',   'en'    =>  'Display Policy Privacy Menu Link'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.show', 'icon' => null, 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
          $updatePolicyPrivacy  =  Permission::create(['name' => 'update_policy_privacy_menus', 'display_name'  => ['ar'  =>  'تعديل قامة السياسات',   'en'    =>  'Edit Policy Privacy Menu Link'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.edit', 'icon' => null, 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '0', 'appear' => '0']);
          $deletePolicyPrivacy  =  Permission::create(['name' => 'delete_policy_privacy_menus', 'display_name'  => ['ar'  =>  'حذف قامة السياسات',   'en'    =>  'Delete Policy Privacy Menu Link'], 'route' => 'policy_privacy_menus', 'module' => 'policy_privacy_menus', 'as' => 'policy_privacy_menus.destroy', 'icon' => null, 'parent' => $managePolicyPrivacyMenus->id, 'parent_original' => $managePolicyPrivacyMenus->id, 'parent_show' => $managePolicyPrivacyMenus->id, 'sidebar_link' => '0', 'appear' => '0']);

    }
}
