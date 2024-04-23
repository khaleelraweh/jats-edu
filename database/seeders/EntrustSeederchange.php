<?php

//web menus Categories

use App\Models\Permission;


//Support menu


// posts
$managePosts = Permission::create(['name' => 'manage_posts', 'display_name' => ['ar'  =>  'إدارة المدونة',    'en'    =>  'Manage Blogs'], 'route' => 'posts', 'module' => 'posts', 'as' => 'posts.index', 'icon' => 'fas fa-postspaper', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '105',]);
$managePosts->parent_show = $managePosts->id;
$managePosts->save();
$showPosts   =  Permission::create(['name'  => 'show_posts', 'display_name'       =>  ['ar'   =>  'المنشورات',   'en'    =>  'Posts'], 'route' => 'posts', 'module' => 'posts', 'as' => 'posts.index', 'icon' => 'fas fa-postspaper', 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '1', 'appear' => '1']);
$createPosts =  Permission::create(['name'  => 'create_posts', 'display_name'     =>  ['ar'   =>  'إنشاء منشور',   'en'    =>  'Create Post'], 'route' => 'posts/create', 'module' => 'posts', 'as' => 'posts.create', 'icon' => null, 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayPosts =  Permission::create(['name' => 'display_posts', 'display_name'    =>  ['ar'   =>  'عرض منشرو',   'en'    =>  'Display Post'], 'route' => 'posts/{posts}', 'module' => 'posts', 'as' => 'posts.show', 'icon' => null, 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '0', 'appear' => '0']);
$updatePosts  =  Permission::create(['name' => 'update_posts', 'display_name'     =>  ['ar'   =>  'تعديل منشور',   'en'    =>  'Edit Post'], 'route' => 'posts/{posts}/edit', 'module' => 'posts', 'as' => 'posts.edit', 'icon' => null, 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '0', 'appear' => '0']);
$deletePosts =  Permission::create(['name'  => 'delete_posts', 'display_name'     =>  ['ar'   =>  'حذف منشور',   'en'    =>  'Delete Post'], 'route' => 'posts/{posts}', 'module' => 'posts', 'as' => 'posts.destroy', 'icon' => null, 'parent' => $managePosts->id, 'parent_original' => $managePosts->id, 'parent_show' => $managePosts->id, 'sidebar_link' => '0', 'appear' => '0']);
