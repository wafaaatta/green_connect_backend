<?php

namespace Database\Seeders;

use Database\Factories\ContactSubmissionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactSubmissionFactory::new()->count(10)->create();
    }
}