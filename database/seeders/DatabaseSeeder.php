<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        DB::table('departments')->insert(['name' => 'TI']);
        DB::table('departments')->insert(['name' => 'Segurança']);
        DB::table('departments')->insert(['name' => 'Cultura']);
        DB::table('departments')->insert(['name' => 'Saúde']);
        DB::table('departments')->insert(['name' => 'Obras']);
        DB::table('departments')->insert(['name' => 'Esporte']);
        DB::table('departments')->insert(['name' => 'Assitência Social']);
        DB::table('departments')->insert(['name' => 'Turismo']);
        DB::table('departments')->insert(['name' => 'Administração']);
        DB::table('departments')->insert(['name' => 'Recursos Humanos']);

        DB::table('department_user')->insert([
            'department_id' => 1,
            'user_id' => 1,
            'created_at' => now()
        ]);

        DB::table('department_user')->insert([
            'department_id' => 2,
            'user_id' => 2,
            'created_at' => now()
        ]);

        DB::table('department_user')->insert([
            'department_id' => 3,
            'user_id' => 3,
            'created_at' => now()
        ]);

        DB::table('people')->insert([
            'name' => 'Guilherme Hallmann',
            'birthday' => '2010-10-10',
            'cpf' => '03565915064',
            'sex' => 'Masculino',
            'city' => 'Caí',
            'neighborhood' => 'Centro',
            'street' => 'Rua das Amoras',
            'number' => '111',
            'created_at' => now(),
        ]);
        DB::table('people')->insert([
            'name' => 'Maria Duarte',
            'birthday' => '2000-09-07',
            'cpf' => '57682062053',
            'sex' => 'Feminino',
            'city' => 'Feliz',
            'neighborhood' => 'Centro',
            'street' => 'Rua das Flores',
            'number' => '222',
            'created_at' => now(),
        ]);
        DB::table('people')->insert([
            'name' => 'Di Trein',
            'birthday' => '1990-08-08',
            'cpf' => '92879280028',
            'sex' => 'Outro',
            'city' => 'Portão',
            'neighborhood' => 'Centro',
            'street' => 'Rua das Portas',
            'number' => '678',
            'created_at' => now(),
        ]);

        DB::table('protocols')->insert([
            'person_id' => 1,
            'department_id' => 1,
            'created_at' => now(),
            'description' => 'Protocolo do contribuinte Guilherme Hallmann, responsabilidade do departamento de TI',
            'deadline' => 10,
        ]);
        
        DB::table('protocols')->insert([
            'person_id' => 2,
            'department_id' => 2,
            'created_at' => now(),
            'description' => 'Protocolo da Maria Duarte, responsabilidade do departamento de Segurança',
            'deadline' => 10,
        ]);

        DB::table('protocols')->insert([
            'person_id' => 3,
            'department_id' => 3,
            'created_at' => now(),
            'description' => 'Protocolo do contribuinte Di Trein, responsabilidade do departamento de Cultura',
            'deadline' => 10,
        ]);



    }
}
