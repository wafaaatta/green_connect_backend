<?php

namespace Database\Seeders;

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
        ArticleCategoryFactory::new()->count(10)->create()->each(function ($category) {
            ArticleFactory::new()->count(4)->create(['article_category_id' => $category->id]);
        });
    }
}