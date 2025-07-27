<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::factory()->create([
            'name' => 'Alice Johnson',
            'email' => 'alice@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::factory()->create([
            'name' => 'Bob Brown',
            'email' => 'bob@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::factory()->create([
            'name' => 'Charlie Wilson',
            'email' => 'charlie@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::factory()->create([
            'name' => 'David Lee',
            'email' => 'david@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::factory()->create([
            'name' => 'Emily Davis',
            'email' => 'emily@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::factory()->create([
            'name' => 'Frank Martin',
            'email' => 'frank@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::factory()->create([
            'name' => 'Grace Clark',
            'email' => 'grace@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
