<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
        'name' => 'jamal',
        'email' => 'jamal@test.com',
        'password' => bcrypt('123456'),
        ]);

        $user->userCmc()->create(['post' => 'directeur']);
    }
}
