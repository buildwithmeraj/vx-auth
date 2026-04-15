<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // seed roles and permissions first to ensure they exist before assigning to users
            RolesAndPermissionsSeeder::class,
            // then seed the admin user with the admin role
            AdminUserSeeder::class,
        ]);
    }
}
