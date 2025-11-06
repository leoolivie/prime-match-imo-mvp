<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Prime Mensal',
                'slug' => 'prime-monthly',
                'description' => 'Plano mensal com até 5 imóveis',
                'price' => 350.00,
                'period' => 'monthly',
                'property_limit' => 5,
                'highlight_limit' => 0,
                'features' => [
                    'Corretor prime',
                    'Suporte básico',
                    'Consultoria',
                ],
                'active' => true,
            ],
            [
                'name' => 'Prime Trimestral',
                'slug' => 'prime-quarterly',
                'description' => 'Plano trimestral com até 15 imóveis',
                'price' => 250.00,
                'period' => 'quarterly',
                'property_limit' => 15,
                'highlight_limit' => 0,
                'features' => [
                    'Corretor prime',
                    'Suporte avançado',
                    'Rede de parceiros',
                ],
                'active' => true,
            ],
            [
                'name' => 'Prime Anual',
                'slug' => 'prime-annual',
                'description' => 'Plano anual com imóveis ilimitados',
                'price' => 200.00,
                'period' => 'annual',
                'property_limit' => null, // Unlimited
                'highlight_limit' => 1,
                'features' => [
                    'Corretor prime',
                    'Suporte premium',
                    'Rede de parceiros',
                    '1 destaque por mês',
                    'Todos os benefícios',
                ],
                'active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::updateOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );
        }
    }
}
