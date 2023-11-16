<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Task;
use App\Models\User;
use App\Models\Status;
use App\Models\Priority;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Status::factory()->count(2)->sequence(
            ['title' => 'todo'],
            ['title' => 'done'],
        )->create();
        Priority::factory()->count(5)->sequence(
            ['title' => 1],
            ['title' => 2],
            ['title' => 3],
            ['title' => 4],
            ['title' => 5],
        )->create();
        User::factory(1)->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
        ]);

        $tasks = Task::factory(100)->create();

        foreach($tasks as $task) {
            $task->users()->attach([1]);
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
