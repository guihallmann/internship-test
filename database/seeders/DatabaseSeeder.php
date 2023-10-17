<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'TI',
            'email' => 'ti@email.com',
            'cpf' => '03565915064',
            'role' => 'Ti',
            'password' => 'tititi',
            'email_verified_at' => now(),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Sys',
            'email' => 'sys@email.com',
            'cpf' => '88817655569',
            'role' => 'Sys',
            'password' => 'syssys',
            'email_verified_at' => now(),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Op',
            'email' => 'op@email.com',
            'cpf' => '12345678999',
            'role' => 'Op',
            'password' => 'opopop',
            'email_verified_at' => now(),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
