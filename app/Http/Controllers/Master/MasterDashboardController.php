<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use App\Models\Subscription;
use App\Models\Partner;
use App\Models\Lead;
use App\Models\TelemetryMetric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasterDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'investors' => User::where('role', 'investor')->count(),
            'businessmen' => User::where('role', 'businessman')->count(),
            'brokers' => User::where('role', 'prime_broker')->count(),
            'total_properties' => Property::count(),
            'active_properties' => Property::where('active', true)->count(),
            'total_subscriptions' => Subscription::where('status', 'active')->count(),
            'visits_30' => TelemetryMetric::globalSum('view_imovel', 30),
            'clicks_30' => TelemetryMetric::globalSum('click_whatsapp_concierge', 30),
        ];
        $stats['conversion'] = $stats['visits_30'] > 0 ? round(($stats['clicks_30'] / $stats['visits_30']) * 100, 1) : 0;

        $recentUsers = User::latest()->take(5)->get();
        $recentProperties = Property::with('owner')->latest()->take(5)->get();

        return view('master.dashboard', compact('stats', 'recentUsers', 'recentProperties'));
    }

    // User Management
    public function users()
    {
        $users = User::withCount(['properties', 'subscriptions'])->paginate(20);
        return view('master.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('master.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:investor,businessman,prime_broker,master',
            'phone' => 'nullable|string|max:20',
            'active' => 'boolean',
            'creci' => 'nullable|string|max:64',
            'cpf_cnpj' => 'nullable|string|max:20',
            'businessman_state' => 'nullable|string|size:2',
            'can_manage_properties' => 'boolean',
        ]);

        if ($request->role === 'businessman' && $request->boolean('can_manage_properties', false)) {
            $request->validate([
                'creci' => 'required|string|max:64',
                'cpf_cnpj' => 'required|string|max:20',
                'businessman_state' => 'required|string|size:2',
            ]);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'active' => $request->boolean('active', true),
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
        ];

        if ($request->role === 'businessman') {
            $data['creci'] = $request->creci;
            $data['cpf_cnpj'] = $request->cpf_cnpj;
            $data['businessman_state'] = $request->businessman_state;
            $data['property_access_requested_at'] = ($request->filled('creci') || $request->filled('cpf_cnpj') || $request->filled('businessman_state')) ? now() : null;
            $data['can_manage_properties'] = $request->boolean('can_manage_properties', false);
            $data['property_access_granted_at'] = $request->boolean('can_manage_properties', false) ? now() : null;
        }

        User::create($data);

        return redirect()->route('master.users')->with('success', 'Usuário criado com sucesso!');
    }

    public function editUser(User $user)
    {
        return view('master.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:investor,businessman,prime_broker,master',
            'phone' => 'nullable|string|max:20',
            'active' => 'boolean',
            'creci' => 'nullable|string|max:64',
            'cpf_cnpj' => 'nullable|string|max:20',
            'businessman_state' => 'nullable|string|size:2',
        ]);

        $data = $request->only(['name', 'email', 'role', 'phone', 'creci', 'cpf_cnpj', 'businessman_state']);
        $data['active'] = $request->boolean('active', true);

        if ($data['role'] !== 'businessman') {
            $data['creci'] = null;
            $data['cpf_cnpj'] = null;
            $data['businessman_state'] = null;
            $data['can_manage_properties'] = false;
            $data['property_access_requested_at'] = null;
            $data['property_access_granted_at'] = null;
        } elseif (!$user->property_access_requested_at && ($request->filled('creci') || $request->filled('cpf_cnpj') || $request->filled('businessman_state'))) {
            $data['property_access_requested_at'] = now();
        }

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('master.users')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('master.users')->with('success', 'Usuário removido com sucesso!');
    }

    // Property Management
    public function properties()
    {
        $properties = Property::with('owner')->withCount('leads')->paginate(20);
        return view('master.properties.index', compact('properties'));
    }

    // Partner Management
    public function partners()
    {
        $partners = Partner::paginate(20);
        return view('master.partners.index', compact('partners'));
    }

    public function createPartner()
    {
        return view('master.partners.create');
    }

    public function storePartner(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:20',
            'category' => 'required|in:legal,financial,construction,architecture,other',
            'active' => 'boolean',
        ]);

        Partner::create($request->all());

        return redirect()->route('master.partners')->with('success', 'Parceiro criado com sucesso!');
    }

    // Subscription Management
    public function subscriptions()
    {
        $subscriptions = Subscription::with(['user', 'plan'])->paginate(20);
        return view('master.subscriptions.index', compact('subscriptions'));
    }

    public function updateBusinessmanPropertyAccess(Request $request, User $user)
    {
        if (!$user->isBusinessman()) {
            return back()->with('error', 'A ação de liberação de imóveis é exclusiva para perfis de empresário.');
        }

        $action = $request->input('action');

        if ($action === 'approve') {
            if (!$user->creci || !$user->cpf_cnpj || !$user->businessman_state) {
                return back()->with('error', 'Informe CRECI, CPF/CNPJ e UF antes de liberar o cadastro de imóveis.');
            }

            $user->update([
                'can_manage_properties' => true,
                'property_access_granted_at' => now(),
                'property_access_requested_at' => $user->property_access_requested_at ?? now(),
            ]);

            return back()->with('success', 'Empresário liberado para cadastrar imóveis.');
        }

        if ($action === 'revoke') {
            $user->update([
                'can_manage_properties' => false,
                'property_access_granted_at' => null,
            ]);

            return back()->with('success', 'Liberação de imóveis revogada.');
        }

        return back()->with('error', 'Ação inválida.');
    }
}
