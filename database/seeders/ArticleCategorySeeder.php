<?php

namespace Database\Seeders;

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
        ArticleCategoryFactory::new()->count(10)->create();
    }
}