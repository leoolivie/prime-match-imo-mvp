<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $businessman = User::where('email', 'businessman@primematch.com')->first();

        if (!$businessman) {
            return;
        }

        $properties = [
            [
                'user_id' => $businessman->id,
                'title' => 'Apartamento Luxuoso em São Paulo',
                'description' => 'Apartamento de alto padrão com 3 suítes, varanda gourmet e vista panorâmica.',
                'type' => 'apartment',
                'transaction_type' => 'sale',
                'price' => 850000.00,
                'address' => 'Av. Paulista, 1000',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01310-100',
                'latitude' => -23.561684,
                'longitude' => -46.655981,
                'bedrooms' => 3,
                'bathrooms' => 3,
                'area' => 120.00,
                'registration_number' => '12345-SP',
                'features' => ['piscina', 'academia', 'salão de festas', 'segurança 24h'],
                'status' => 'available',
                'highlighted' => true,
                'highlighted_until' => now()->addMonth(),
                'active' => true,
            ],
            [
                'user_id' => $businessman->id,
                'title' => 'Casa em Condomínio Fechado - Alphaville',
                'description' => 'Linda casa com 4 quartos, piscina e churrasqueira.',
                'type' => 'house',
                'transaction_type' => 'sale',
                'price' => 1200000.00,
                'address' => 'Alameda dos Anjos, 500',
                'city' => 'Barueri',
                'state' => 'SP',
                'zip_code' => '06454-000',
                'latitude' => -23.508638,
                'longitude' => -46.852357,
                'bedrooms' => 4,
                'bathrooms' => 4,
                'area' => 250.00,
                'registration_number' => '67890-SP',
                'features' => ['piscina', 'churrasqueira', 'jardim', 'garagem 4 vagas'],
                'status' => 'available',
                'highlighted' => false,
                'active' => true,
            ],
            [
                'user_id' => $businessman->id,
                'title' => 'Sala Comercial no Centro',
                'description' => 'Sala comercial moderna, ideal para escritórios.',
                'type' => 'commercial',
                'transaction_type' => 'rent',
                'price' => 3500.00,
                'address' => 'Rua XV de Novembro, 200',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01013-000',
                'latitude' => -23.545965,
                'longitude' => -46.634934,
                'bedrooms' => 0,
                'bathrooms' => 2,
                'area' => 80.00,
                'registration_number' => '11223-SP',
                'features' => ['ar condicionado', 'elevador', 'recepção'],
                'status' => 'available',
                'highlighted' => false,
                'active' => true,
            ],
        ];

        foreach ($properties as $property) {
            Property::create($property);
        }
    }
}
