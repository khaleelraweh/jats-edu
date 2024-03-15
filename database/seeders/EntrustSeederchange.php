<?php

//web menus Categories

use App\Models\Permission;


//Support menu
//course Reviews
$manageCourseReviews = Permission::create(['name' => 'manage_course_reviews', 'display_name' => ['ar' =>  'إدارة التعليقات',  'en'    =>  'Manage Comments'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.index', 'icon' => 'fas fa-comment', 'parent' => '0', 'parent_original' => '0', 'sidebar_link' => '1', 'appear' => '1', 'ordering' => '65',]);
$manageCourseReviews->parent_show = $manageCourseReviews->id;
$manageCourseReviews->save();
$showCourseReviews   =  Permission::create(['name' => 'show_course_reviews',  'display_name'      =>  ['ar'   =>  'التعليقات',   'en'    =>  'Comments'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.index', 'icon' => 'fas fa-comment', 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '1', 'appear' => '1']);
$createCourseReviews =  Permission::create(['name' => 'create_course_reviews', 'display_name'     =>  ['ar'   =>  'إضافة تعليق',   'en'    =>  'Create Comment'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.create', 'icon' => null, 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '1', 'appear' => '0']);
$displayCourseReviews =  Permission::create(['name' => 'display_course_reviews', 'display_name'   =>  ['ar'   =>  'عرض تعليق',   'en'    =>  'Display Comment'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.show', 'icon' => null, 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
$updateCourseReviews  =  Permission::create(['name' => 'update_course_reviews', 'display_name'    =>  ['ar'   =>  'تعديل تعليق',   'en'    =>  'Edit Comment'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.edit', 'icon' => null, 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
$deleteCourseReviews =  Permission::create(['name' => 'delete_course_reviews', 'display_name'     =>  ['ar'   =>  'حذف تعليق',   'en'    =>  'Delete Comment'], 'route' => 'course_reviews', 'module' => 'course_reviews', 'as' => 'course_reviews.destroy', 'icon' => null, 'parent' => $manageCourseReviews->id, 'parent_original' => $manageCourseReviews->id, 'parent_show' => $manageCourseReviews->id, 'sidebar_link' => '0', 'appear' => '0']);
