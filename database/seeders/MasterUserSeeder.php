<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MasterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'admin@primematchimo.com';
        $password = 'Admin@123';

        $user = User::where('email', $email)->first();

        if ($user) {
            $user->update([
                'name' => 'Admin PrimeMatch',
                'role' => 'master',
                'password' => Hash::make($password),
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'active' => true,
            ]);
        } else {
            User::create([
                'name' => 'Admin PrimeMatch',
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'master',
                'phone' => null,
                'whatsapp' => null,
                'terms_accepted' => true,
                'terms_accepted_at' => now(),
                'active' => true,
            ]);
        }
    }
}
