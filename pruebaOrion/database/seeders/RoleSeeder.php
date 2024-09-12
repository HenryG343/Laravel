<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roleAdmin = Role::create([
            'name' => 'administrador',
            'guard_name' => 'sanctum',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);
        $roleProfesor = Role::create([
            'name' => 'profesor',
            'guard_name' => 'sanctum',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),

        ]);
        $roleUser = Role::create([
            'name' => 'usuario',
            'guard_name' => 'sanctum',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);
        $roleAdmin->syncPermissions(Permission::all('name')->toArray());
        Permission::create(['name'=>'cursos.index',"guard_name" => "sanctum",])->syncRoles([$roleAdmin,$roleProfesor,$roleUser]);
        Permission::create(['name'=>'cursos.create',"guard_name" => "sanctum",])->syncRoles([$roleAdmin,$roleProfesor]);
        Permission::create(['name'=>'cursos.edit',"guard_name" => "sanctum",])->syncRoles([$roleAdmin,$roleProfesor]);
        Permission::create(['name'=>'cursos.destroy',"guard_name" => "sanctum",])->syncRoles([$roleAdmin,$roleProfesor]);
    }
}
