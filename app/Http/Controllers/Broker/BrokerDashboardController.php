<?php

namespace App\Http\Controllers\Broker;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrokerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get all leads (assigned or unassigned)
        $leads = Lead::with(['property', 'investor', 'primeBroker'])
            ->whereNull('prime_broker_id')
            ->orWhere('prime_broker_id', $user->id)
            ->latest()
            ->paginate(20);

        $stats = [
            'total_leads' => Lead::where('prime_broker_id', $user->id)->count(),
            'new_leads' => Lead::where('prime_broker_id', $user->id)->where('status', 'new')->count(),
            'contacted' => Lead::where('prime_broker_id', $user->id)->where('status', 'contacted')->count(),
            'won' => Lead::where('prime_broker_id', $user->id)->where('status', 'won')->count(),
        ];

        return view('broker.dashboard', compact('leads', 'stats'));
    }

    public function claimLead(Lead $lead)
    {
        if ($lead->prime_broker_id && $lead->prime_broker_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Este lead já foi atribuído a outro corretor.');
        }

        $lead->update([
            'prime_broker_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Lead atribuído com sucesso!');
    }

    public function updateLead(Request $request, Lead $lead)
    {
        // Ensure the broker owns this lead
        if ($lead->prime_broker_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Você não tem permissão para atualizar este lead.');
        }

        $request->validate([
            'status' => 'required|in:new,contacted,viewing_scheduled,viewing_done,negotiating,won,lost',
            'notes' => 'nullable|string',
        ]);

        $data = [
            'status' => $request->status,
            'notes' => $request->notes,
        ];

        if ($request->status === 'contacted' && !$lead->contacted_at) {
            $data['contacted_at'] = now();
        }

        $lead->update($data);

        return redirect()->back()->with('success', 'Lead atualizado com sucesso!');
    }
}
