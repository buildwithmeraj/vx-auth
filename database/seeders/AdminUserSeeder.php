<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $userId = env('ADMIN_USERID');
        $password = env('ADMIN_PASSWORD');

        if (! $email || ! $userId || ! $password) {
            $this->command?->warn('Admin user not seeded. Set ADMIN_EMAIL, ADMIN_USERID, and ADMIN_PASSWORD in .env and re-run db:seed.');
            return;
        }

        User::updateOrCreate(
            ['email' => $email],
            [
                'userID' => $userId,
                'first_name' => 'Admin',
                'last_name' => 'User',
                'role' => 'admin',
                'password' => $password,
                'password_set' => 1,
                'photo' => 'https://ui-avatars.com/api/?name=Admin&background=4f46e5&color=ffffff&size=256',
                'gender' => 'other',
                'phone' => '+0000000000',
                'address' => 'N/A',
                'reset_token' => null,
            ]
        );
    }
}

