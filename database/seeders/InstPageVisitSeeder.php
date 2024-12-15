<?php

namespace Database\Seeders;

use App\Models\InstPageVisit;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstPageVisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstPageVisit::create([
            'page' => ['ar' => 'الرئيسية', 'en' => 'Main'],
            'route' =>  'index',
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => ['ar' => 'صفحة قائمة الدورات', 'en' => 'Courses List page'],
            'route' =>  'courses-list',
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => ['ar' => 'صفحة قائمة الاحداث القائمة', 'en' => 'Events List page'],
            'route' =>  'event-list',
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => ['ar' => 'صفحة قائمة الأخبار', 'en' => 'News List page'],
            'route' =>  'news-list',
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => ['ar' => 'صفحة قائمة تاجات الاخبار', 'en' => 'News tag List page'],
            'route' =>  'news-tag-list',
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => ['ar' => 'صفحة قائمة المدربين', 'en' => 'Instructors List page'],
            'route' =>  'instructors-list',
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
    }
}
