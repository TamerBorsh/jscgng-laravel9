<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name_ar' => 'الأنشطة والفعاليات', 'name_en' => 'Activities and events', 'slug' => 'activities-and-events']);
        Category::create(['name_ar' => 'آخر المشاريع', 'name_en' => 'Latest Projects', 'slug' => 'latest-projects']);
        Category::create(['name_ar' => 'معرض الصور', 'name_en' => 'Photo Gallery', 'slug' => 'photo-gallery']);
    }
}
