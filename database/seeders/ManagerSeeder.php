<?php

namespace Database\Seeders;

use Database\Factories\ManagerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!\App\Models\Manager::query()->where('id', 1)->exists()) {
            ManagerFactory::new() -> create([
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('12345678'),
            ]);
        }
    }
}