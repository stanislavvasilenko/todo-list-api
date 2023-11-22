<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::factory()->count(5)->sequence(
            ['title' => 1],
            ['title' => 2],
            ['title' => 3],
            ['title' => 4],
            ['title' => 5],
        )->create();
    }
}
