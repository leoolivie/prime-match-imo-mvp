<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Property;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrimeMatchImoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function landing_page_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Prime Match Imo');
    }

    /** @test */
    public function investor_landing_page_is_accessible()
    {
        $response = $this->get('/investidor');
        $response->assertStatus(200);
        $response->assertSee('Experiência prime para investidores');
    }

    /** @test */
    public function businessman_landing_page_is_accessible()
    {
        $response = $this->get('/empresario');
        $response->assertStatus(200);
        $response->assertSee('Experiência prime para empresários');
    }

    /** @test */
    public function master_landing_page_is_accessible()
    {
        $response = $this->get('/master-landing');
        $response->assertStatus(200);
        $response->assertSee('Comando total para masters');
    }

    /** @test */
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

    /** @test */
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

    /** @test */
    public function investor_can_access_dashboard()
    {
        $investor = User::factory()->create(['role' => 'investor']);

        $response = $this->actingAs($investor)->get('/investor/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard do Investidor');
    }

    /** @test */
    public function businessman_can_access_dashboard()
    {
        $businessman = User::factory()->create(['role' => 'businessman']);

        $response = $this->actingAs($businessman)->get('/businessman/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard do Empresário');
    }

    /** @test */
    public function master_can_access_businessman_dashboard()
    {
        $master = User::factory()->create(['role' => 'master']);

        $response = $this->actingAs($master)->get('/businessman/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard do Empresário');
    }

    /** @test */
    public function investor_cannot_access_businessman_dashboard()
    {
        $investor = User::factory()->create(['role' => 'investor']);

        $response = $this->actingAs($investor)->get('/businessman/dashboard');
        $response->assertStatus(403);
    }

    /** @test */
    public function broker_can_access_dashboard()
    {
        $broker = User::factory()->create(['role' => 'prime_broker']);

        $response = $this->actingAs($broker)->get('/broker/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard do Corretor');
    }

    /** @test */
    public function master_can_access_dashboard()
    {
        $master = User::factory()->create(['role' => 'master']);

        $response = $this->actingAs($master)->get('/master/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Master');
    }

    /** @test */
    public function businessman_cannot_access_master_dashboard()
    {
        $businessman = User::factory()->create(['role' => 'businessman']);

        $response = $this->actingAs($businessman)->get('/master/dashboard');
        $response->assertStatus(403);
    }

    /** @test */
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

    /** @test */
    public function property_registration_number_is_hidden_by_default()
    {
        $property = Property::factory()->create([
            'registration_number' => 'SECRET123',
        ]);

        $propertyArray = $property->toArray();
        $this->assertArrayNotHasKey('registration_number', $propertyArray);
    }

    /** @test */
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
