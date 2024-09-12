<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cursos;
use App\Models\UserCursos;
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
        $this->call([RoleSeeder::class,UserSeeder::class]);
        User::factory(10)->create();
        Cursos::factory(10)->create();
        UserCursos::factory(5)->create();
    }
}
