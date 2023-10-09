<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['title' => Role::ROLE_MANAGER],
            ['title' => Role::ROLE_USER],
        ]);

        $adminRole = Role::where('title', Role::ROLE_MANAGER)->first();

        $admin = new User();
        $admin->name = 'Test Manager';
        $admin->email = 'manager@gmail.com';
        $admin->password = bcrypt('password');
        $admin->save(); // Save the user first

        // Attach roles after saving the user
        $admin->roles()->attach([$adminRole->id]);
    }
}
