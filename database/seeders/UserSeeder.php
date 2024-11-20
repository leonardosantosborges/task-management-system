<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Igor Pereira',
            'email' => 'igor@exata.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Leonardo Borges',
            'email' => 'leonardo@exata.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::factory(10)->create();

    }
}
