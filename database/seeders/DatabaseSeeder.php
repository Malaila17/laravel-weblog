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
        User::factory()->create([
            'username' => 'wieke',
            'password' => 'wieke',
        ]);
        
        User::factory()->create([
            'username' => 'jasper',
            'password' => 'jasper',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            ArticleSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
