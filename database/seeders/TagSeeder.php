<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => ['ar' => 'Pupga', 'en' => 'PUPGA', 'ca' => 'PUPGAspan'], 'slug' => ['ar' => 'Pupga', 'en' => 'Pubga', 'ca' => 'Pubga-Span'],  'section' => 3,  'status' => true]);
        Tag::create(['name' => ['ar' => 'إنمي', 'en' => 'Enimy', 'ca' => 'EnimySpan'], 'slug' => ['ar' => 'إنمي', 'en' => 'Enimay', 'ca' => 'Enimay-Span'],  'section' => 3,  'status' => true]);
        Tag::create(['name' => ['ar' => 'كروت', 'en' => 'Enimy', 'ca' => 'Cardspan'], 'slug' => ['ar' => 'كروت', 'en' => 'cards', 'ca' => 'cards-Span'],  'section' => 3,  'status' => true]);
        Tag::create(['name' => ['ar' => 'عروض', 'en' => 'offers', 'ca' => 'offerspan'], 'slug' => ['ar' => 'عروض', 'en' => 'offers', 'ca' => 'offers-Span'],  'section' => 3,  'status' => true]);
        Tag::create(['name' => ['ar' => 'منتج', 'en' => 'Product', 'ca' => 'ProductSpan'], 'slug' => ['ar' => 'منتج', 'en' => 'Product', 'ca' => 'Product-Span'],  'section' => 3,  'status' => true]);
    }
}
