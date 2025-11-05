<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Master/Admin user
        $master = User::create([
            'name' => 'Admin Master',
            'email' => 'master@primematch.com',
            'password' => Hash::make('password'),
            'role' => 'master',
            'phone' => '(11) 99999-0001',
            'whatsapp' => '5511999990001',
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'active' => true,
        ]);

        // Prime Broker user
        $broker = User::create([
            'name' => 'Carlos Silva',
            'email' => 'broker@primematch.com',
            'password' => Hash::make('password'),
            'role' => 'prime_broker',
            'phone' => '(11) 99999-0002',
            'whatsapp' => '5511999990002',
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'active' => true,
        ]);

        // Businessman user with subscription
        $businessman = User::create([
            'name' => 'João Empresário',
            'email' => 'businessman@primematch.com',
            'password' => Hash::make('password'),
            'role' => 'businessman',
            'phone' => '(11) 99999-0003',
            'whatsapp' => '5511999990003',
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'active' => true,
        ]);

        // Create active subscription for businessman
        $monthlyPlan = SubscriptionPlan::where('slug', 'prime-monthly')->first();
        Subscription::create([
            'user_id' => $businessman->id,
            'subscription_plan_id' => $monthlyPlan->id,
            'start_date' => now(),
            'end_date' => now()->addMonth(),
            'status' => 'active',
        ]);

        // Investor user
        $investor = User::create([
            'name' => 'Maria Investidora',
            'email' => 'investor@primematch.com',
            'password' => Hash::make('password'),
            'role' => 'investor',
            'phone' => '(11) 99999-0004',
            'whatsapp' => '5511999990004',
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'active' => true,
        ]);

        // Additional users for testing
        User::create([
            'name' => 'Pedro Investidor',
            'email' => 'investor2@primematch.com',
            'password' => Hash::make('password'),
            'role' => 'investor',
            'phone' => '(11) 99999-0005',
            'whatsapp' => '5511999990005',
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'active' => true,
        ]);

        User::create([
            'name' => 'Ana Empresária',
            'email' => 'businessman2@primematch.com',
            'password' => Hash::make('password'),
            'role' => 'businessman',
            'phone' => '(11) 99999-0006',
            'whatsapp' => '5511999990006',
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
            'active' => true,
        ]);
    }
}
