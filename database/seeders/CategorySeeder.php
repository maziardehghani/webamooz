<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Defining programming categories and subcategories
        $categories = [
            'Web Development' => ['Frontend', 'Backend', 'Full Stack'],
            'Mobile Development' => ['Android', 'iOS', 'Cross-Platform'],
            'Data Science' => ['Machine Learning', 'Deep Learning', 'Data Analysis'],
            'Game Development' => ['Unity', 'Unreal Engine', 'Game Design'],
            'Cyber Security' => ['Penetration Testing', 'Network Security', 'Cryptography'],
        ];

        $parentCategories = [];

        // Insert parent categories
        foreach ($categories as $parent => $children) {
            $parentId = DB::table('category')->insertGetId([
                'title' => $parent,
                'slug' => Str::slug($parent),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $parentCategories[$parent] = $parentId;
        }

        // Insert child categories
        foreach ($categories as $parent => $children) {
            foreach ($children as $child) {
                DB::table('category')->insert([
                    'parent_id' => $parentCategories[$parent],
                    'title' => $child,
                    'slug' => Str::slug($child),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
