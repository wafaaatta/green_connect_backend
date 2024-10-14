<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Database\Factories\ArticleCategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Indoor Plants'],
            ['name' => 'Outdoor Gardening'],
            ['name' => 'Plant Care Tips'],
            ['name' => 'Sustainable Living'],
            ['name' => 'Rare Plants'],
            ['name' => 'Green Innovations'],
        ];
        foreach ($categories as $category) {
            ArticleCategory::create($category);
        }
        //ArticleCategoryFactory::new()->count(10)->create();
    }
}