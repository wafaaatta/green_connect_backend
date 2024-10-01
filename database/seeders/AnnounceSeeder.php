<?php

namespace Database\Seeders;

use App\Models\Announce;
use App\Models\User;
use Database\Factories\AnnounceFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnounceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            $count = rand(1, 50);
            AnnounceFactory::new()->count(5)->create(['user_id' => $user->id]);
        });
    }
}