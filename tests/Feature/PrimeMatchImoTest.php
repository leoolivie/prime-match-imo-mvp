<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Property;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PrimeMatchImoTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function landing_page_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Prime Match Imo');
    }

    #[Test]
    public function investor_landing_page_is_accessible()
    {
        $response = $this->get('/investidor');
        $response->assertStatus(200);
        $response->assertSee('Descubra imóveis curados pelo concierge');
    }

    #[Test]
    public function businessman_landing_page_is_accessible()
    {
        $response = $this->get('/empresario');
        $response->assertStatus(200);
        $response->assertSee('Apresentação de Plataforma Exclusiva para Empresários');
    }

    #[Test]
    public function master_landing_page_is_accessible()
    {
        $response = $this->get('/master-landing');
        $response->assertStatus(200);
        $response->assertSee('Comando total para masters');
    }

    #[Test]
    public function users_can_register_as_investor_or_businessman()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'investor',
            'terms' => true,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'role' => 'investor',
        ]);
    }

    #[Test]
    public function users_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function investor_can_access_dashboard()
    {
        $investor = User::factory()->create(['role' => 'investor']);

        $response = $this->actingAs($investor)->get('/investor/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard do Investidor');
    }

    #[Test]
    public function businessman_can_access_dashboard()
    {
        $businessman = User::factory()->create(['role' => 'businessman']);

        $response = $this->actingAs($businessman)->get('/businessman/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Gerencie seu portfólio com suporte concierge');
    }

    #[Test]
    public function master_can_access_businessman_dashboard()
    {
        $master = User::factory()->create(['role' => 'master']);

        $response = $this->actingAs($master)->get('/businessman/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Gerencie seu portfólio com suporte concierge');
    }

    #[Test]
    public function master_can_access_investor_dashboard()
    {
        $master = User::factory()->create(['role' => 'master']);

        $response = $this->actingAs($master)->get('/investor/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Bem-vindo ao seu cockpit cinematográfico');
    }

    #[Test]
    public function investor_cannot_access_businessman_dashboard()
    {
        $investor = User::factory()->create(['role' => 'investor']);

        $response = $this->actingAs($investor)->get('/businessman/dashboard');
        $response->assertStatus(403);
    }

    #[Test]
    public function broker_can_access_dashboard()
    {
        $broker = User::factory()->create(['role' => 'prime_broker']);

        $response = $this->actingAs($broker)->get('/broker/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Curadoria compartilhada com apoio direto do concierge');
    }

    #[Test]
    public function master_can_access_dashboard()
    {
        $master = User::factory()->create(['role' => 'master']);

        $response = $this->actingAs($master)->get('/master/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Master');
    }

    #[Test]
    public function businessman_cannot_access_master_dashboard()
    {
        $businessman = User::factory()->create(['role' => 'businessman']);

        $response = $this->actingAs($businessman)->get('/master/dashboard');
        $response->assertStatus(403);
    }

    #[Test]
    public function master_can_access_businessman_properties_index()
    {
        $master = User::factory()->create(['role' => 'master']);

        $response = $this->actingAs($master)->get('/businessman/properties');
        $response->assertOk();
        $response->assertSee('Imóveis cadastrados');
    }

    #[Test]
    public function master_can_subscribe_to_businessman_plan()
    {
        $master = User::factory()->create(['role' => 'master']);
        $plan = SubscriptionPlan::factory()->create([
            'period' => 'monthly',
        ]);

        $response = $this->actingAs($master)->post("/businessman/subscribe/{$plan->id}");

        $response->assertRedirect(route('businessman.dashboard'));
        $this->assertDatabaseHas('subscriptions', [
            'user_id' => $master->id,
            'subscription_plan_id' => $plan->id,
            'status' => 'active',
        ]);
    }

    #[Test]
    public function master_with_active_subscription_can_create_businessman_property()
    {
        $master = User::factory()->create(['role' => 'master']);
        $plan = SubscriptionPlan::factory()->create([
            'property_limit' => 5,
            'period' => 'monthly',
        ]);

        Subscription::factory()
            ->for($master)
            ->for($plan)
            ->create([
                'start_date' => now(),
                'end_date' => now()->addMonth(),
                'status' => 'active',
            ]);

        $payload = [
            'title' => 'Master Property',
            'description' => 'Descrição do imóvel master.',
            'type' => 'apartment',
            'transaction_type' => 'sale',
            'price' => 750000,
            'address' => 'Rua Exemplo, 123',
            'city' => 'São Paulo',
            'state' => 'SP',
            'zip_code' => '12345-678',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area' => 120,
            'parking' => 2,
            'year_built' => 2020,
            'action' => 'publish',
        ];

        $response = $this->actingAs($master)->post('/businessman/properties', $payload);

        $response->assertRedirect();
        $this->assertDatabaseHas('properties', [
            'title' => 'Master Property',
            'user_id' => $master->id,
            'active' => true,
        ]);
    }

    #[Test]
    public function businessman_with_subscription_can_create_property()
    {
        $businessman = User::factory()->create(['role' => 'businessman']);
        $plan = SubscriptionPlan::factory()->create([
            'property_limit' => 5,
        ]);
        Subscription::factory()->create([
            'user_id' => $businessman->id,
            'subscription_plan_id' => $plan->id,
            'status' => 'active',
            'end_date' => now()->addMonth(),
        ]);

        $response = $this->actingAs($businessman)->post('/businessman/properties', [
            'title' => 'Test Property',
            'description' => 'A beautiful property',
            'type' => 'apartment',
            'transaction_type' => 'sale',
            'price' => 500000,
            'address' => 'Test Address',
            'city' => 'São Paulo',
            'state' => 'SP',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('properties', [
            'title' => 'Test Property',
            'user_id' => $businessman->id,
        ]);
    }

    #[Test]
    public function property_registration_number_is_hidden_by_default()
    {
        $property = Property::factory()->create([
            'registration_number' => 'SECRET123',
        ]);

        $propertyArray = $property->toArray();
        $this->assertArrayNotHasKey('registration_number', $propertyArray);
    }

    #[Test]
    public function subscription_plan_limits_are_enforced()
    {
        $plan = SubscriptionPlan::factory()->create([
            'property_limit' => 2,
        ]);

        $this->assertEquals(2, $plan->property_limit);
        $this->assertFalse($plan->isUnlimited());

        $unlimitedPlan = SubscriptionPlan::factory()->create([
            'property_limit' => null,
        ]);

        $this->assertTrue($unlimitedPlan->isUnlimited());
    }
}
