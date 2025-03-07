<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        $superAdmin = new Role();
        $superAdmin->name = 'super_admin';
        $superAdmin->save();
        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();
        $roadmapAdmin = new Role();
        $roadmapAdmin->name = 'roadmap_admin';
        $roadmapAdmin->save();
        $userRole = new Role();
        $userRole->name = 'user';
        $userRole->save();

        //
    }
}
