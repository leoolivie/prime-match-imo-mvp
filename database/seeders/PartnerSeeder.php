<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Advocacia Silva & Associados',
                'logo' => null,
                'description' => 'Escritório especializado em direito imobiliário',
                'website' => 'https://www.silvaadvocacia.com.br',
                'contact_email' => 'contato@silvaadvocacia.com.br',
                'contact_phone' => '(11) 3333-4444',
                'category' => 'legal',
                'active' => true,
            ],
            [
                'name' => 'Banco Imobiliário Premium',
                'logo' => null,
                'description' => 'Soluções de financiamento imobiliário com as melhores taxas',
                'website' => 'https://www.bancoimobiliario.com.br',
                'contact_email' => 'contato@bancoimobiliario.com.br',
                'contact_phone' => '(11) 2222-3333',
                'category' => 'financial',
                'active' => true,
            ],
            [
                'name' => 'Construtora MegaObras',
                'logo' => null,
                'description' => 'Construção e reformas de alto padrão',
                'website' => 'https://www.megaobras.com.br',
                'contact_email' => 'contato@megaobras.com.br',
                'contact_phone' => '(11) 4444-5555',
                'category' => 'construction',
                'active' => true,
            ],
            [
                'name' => 'Arquitetura & Design Premium',
                'logo' => null,
                'description' => 'Projetos arquitetônicos exclusivos',
                'website' => 'https://www.arquiteturadesign.com.br',
                'contact_email' => 'contato@arquiteturadesign.com.br',
                'contact_phone' => '(11) 5555-6666',
                'category' => 'architecture',
                'active' => true,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
