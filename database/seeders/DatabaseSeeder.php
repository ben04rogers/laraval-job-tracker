<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'email' => 'testuser@email.com',
            'password' => Hash::make('test123'),
            'name' => 'Test User',
        ]);
        Job::factory(10)->create();

        Todo::factory(30)->create();
    }
}
