<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //
        $user = User::create(
            [
                'name'=> 'administrador',
                'email' => 'admin@correo.com',
                'email_verified_at' => now(),
                'password'    => Hash::make('12345'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $user->assignRole('administrador');
        $user = User::create(
            [
                'name'=> 'profe',
                'email' => 'profe@correo.com',
                'email_verified_at' => now(),
                'password'    => Hash::make('12345'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $user->assignRole('profesor');
        $user = User::create(
            [
                'name'=> 'usuario',
                'email' => 'usuario@correo.com',
                'email_verified_at' => now(),
                'password'    => Hash::make('12345'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        $user->assignRole('usuario');
    }
}
