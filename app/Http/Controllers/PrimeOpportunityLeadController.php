<?php

namespace App\Http\Controllers;

use App\Models\PrimeLead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PrimeOpportunityLeadController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:150'],
            'phone' => ['required', 'string', 'max:40'],
            'profile_type' => ['required', 'string', 'in:investor,businessman'],
        ]);

        PrimeLead::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'profile_type' => $validated['profile_type'],
            'vip_opt_in' => $request->boolean('vip_opt_in'),
            'source' => 'oportunidades-prime',
            'opportunity_reference' => $request->input('opportunity_reference'),
            'meta' => array_filter([
                'utm_source' => $request->input('utm_source'),
                'utm_medium' => $request->input('utm_medium'),
                'utm_campaign' => $request->input('utm_campaign'),
            ]),
        ]);

        return back()->with('lead_success', 'Recebemos seus dados. O concierge Prime entrará em contato com as próximas oportunidades.');
    }
}
