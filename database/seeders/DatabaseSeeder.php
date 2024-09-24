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
            AnnounceSeeder::class,
            UserSeeder::class,
            ManagerSeeder::class,
            ArticleSeeder::class
        ]);
        
    }
}