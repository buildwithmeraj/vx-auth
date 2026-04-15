<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // define admin user details
        $adminEmail = 'admin@example.com';
        $adminUserId = 'VX000001';
        $adminPassword = 'Admin12345';

        // create or update the admin user
        $admin = User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'userID' => $adminUserId,
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => $adminPassword,
                'password_set' => 1,
                'photo' => 'https://ui-avatars.com/api/?name=Admin+User&background=4f46e5&color=ffffff&size=256',
                'gender' => 'other',
                'phone' => '+0000000000',
                'address' => 'N/A',
                'reset_token' => null,
            ]
        );

        // assign the admin role to the user
        $admin->syncRoles(['admin']);
    }
}
