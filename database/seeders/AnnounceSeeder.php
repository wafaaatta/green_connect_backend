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
            AnnounceFactory::new()->count(6)->create(['user_id' => $user->id]);
        });
    }
}