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
            'page' => ['ar' => 'Main', 'en' => 'الرئيسية'],
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => ['ar' => 'Courses List page', 'en' => 'صفحة قائمة الدورات'],
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => ['ar' => 'ُEvents List page', 'en' => 'صفحة قائمة الاحداث'],
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => ['ar' => 'News List page', 'en' => 'صفحة قائمة الاخبار'],
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => ['ar' => 'Instructors List page', 'en' => 'صفحة قائمة المدربين'],
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
    }
}
