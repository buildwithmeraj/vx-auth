<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();

        // generate a unique userID with 'VX' prefix followed by a random 6-digit number
        do {
            $userId = 'VX' . fake()->numberBetween(100000, 999999);
        } while (User::where('userID', $userId)->exists());

        return [
            'userID' => $userId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'photo' => fake()->imageUrl(256, 256, 'people'),
            'phone' => fake()->phoneNumber(),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'address' => fake()->address(),
            'reset_token' => null,
            'remember_token' => Str::random(10),
            'password_set' => 1,
        ];
    }
}
