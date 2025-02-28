<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = new User();
        $superAdmin->user_name='superAdmin';
        $superAdmin->email='hit.bits.1509@gmail.com';
        $superAdmin->password='12345678';
        $superAdmin->full_name='superAdmin';
        $superAdmin->assignRole('super_admin');
        $superAdmin->save();
    }
}
