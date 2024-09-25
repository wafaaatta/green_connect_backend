<?php

namespace Database\Seeders;

use App\Models\Announce;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ManagerSeeder::class,
            AnnounceSeeder::class,
            ArticleCategorySeeder::class,
            ArticleSeeder::class,
            EventSeeder::class
        ]);
        
    }
}