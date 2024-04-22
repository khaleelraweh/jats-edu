<?php

//web menus Categories

use App\Models\Permission;


//Support menu

//Reviews
$manageReviews = Permission::create(['name' => 'manage_reviews', 'display_name' => ['ar' =>  'إدارة التعليقات',  'en'    =>  'Manage Reviews'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '65',]);
$manageReviews->parent_show = $manageReviews->id;
$manageReviews->save();
$showReviews   =  Permission::create(['name' => 'show_reviews',  'display_name'      =>  ['ar'   =>  'التعليقات',   'en'    =>  'Reviews'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.index', 'icon' => 'fas fa-comment', 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '1', 'appear' => '1']);
$createReviews =  Permission::create(['name' => 'create_reviews', 'display_name'     =>  ['ar'   =>  'إضافة تعليق',   'en'    =>  'Create Review'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.create', 'icon' => null, 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayReviews =  Permission::create(['name' => 'display_reviews', 'display_name'   =>  ['ar'   =>  'عرض تعليق',   'en'    =>  'Display Review'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.show', 'icon' => null, 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateReviews  =  Permission::create(['name' => 'update_reviews', 'display_name'    =>  ['ar'   =>  'تعديل تعليق',   'en'    =>  'Edit Review'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.edit', 'icon' => null, 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteReviews =  Permission::create(['name' => 'delete_reviews', 'display_name'     =>  ['ar'   =>  'حذف تعليق',   'en'    =>  'Delete Review'], 'route' => 'reviews', 'module' => 'reviews', 'as' => 'reviews.destroy', 'icon' => null, 'parent' => $manageReviews->id, 'parent_original' => $manageReviews->id, 'parent_show' => $manageReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
