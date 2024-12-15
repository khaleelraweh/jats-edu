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
            'page' => 'courses_list',
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => 'blog_list',
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
        InstPageVisit::create([
            'page' => 'event_list',
            'views' => 0,
            'visited_at' => Carbon::now(),
        ]);
    }
}
