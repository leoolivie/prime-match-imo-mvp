<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use App\Models\Subscription;
use App\Models\Partner;
use App\Models\Lead;
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
            'total_leads' => Lead::count(),
        ];

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
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'active' => $request->boolean('active', true),
            'terms_accepted' => true,
            'terms_accepted_at' => now(),
        ]);

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
        ]);

        $data = $request->only(['name', 'email', 'role', 'phone']);
        $data['active'] = $request->boolean('active', true);

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
        $properties = Property::with('owner')->paginate(20);
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
}
