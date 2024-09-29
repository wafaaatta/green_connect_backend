<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Database\Factories\ArticleCategoryFactory;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ArticleCategory::all()->each(function ($articleCategory) {
            ArticleFactory::new()->count(1000)->create([
                'article_category_id' => $articleCategory->id,
                'manager_id' => 1
            ]);
        });
    }
}