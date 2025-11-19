<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Support\PrimeOpportunityContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrimeOpportunityController extends Controller
{
    public function edit(): View
    {
        $content = PrimeOpportunityContent::get();

        return view('master.opportunities.edit', compact('content'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_badge' => ['required', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_description' => ['required', 'string'],
            'hero_support_text' => ['required', 'string'],
            'hero_businessman_cta_label' => ['required', 'string', 'max:255'],
            'hero_investor_cta_label' => ['required', 'string', 'max:255'],
            'cta_card_badge' => ['required', 'string', 'max:255'],
            'cta_card_title' => ['required', 'string'],
            'cta_card_description' => ['required', 'string'],
            'cta_card_steps' => ['required', 'json'],
            'cta_card_vip_title' => ['required', 'string', 'max:255'],
            'cta_card_vip_description' => ['required', 'string'],
            'hero_metrics' => ['required', 'json'],
            'mentors' => ['required', 'json'],
            'partners' => ['required', 'json'],
            'opportunities' => ['required', 'json'],
            'insights' => ['required', 'json'],
        ]);

        PrimeOpportunityContent::update([
            'hero' => [
                'badge' => $validated['hero_badge'],
                'title' => $validated['hero_title'],
                'description' => $validated['hero_description'],
                'support_text' => $validated['hero_support_text'],
                'businessman_cta_label' => $validated['hero_businessman_cta_label'],
                'investor_cta_label' => $validated['hero_investor_cta_label'],
            ],
            'cta_card' => [
                'badge' => $validated['cta_card_badge'],
                'title' => $validated['cta_card_title'],
                'description' => $validated['cta_card_description'],
                'steps' => json_decode($validated['cta_card_steps'], true),
                'vip_title' => $validated['cta_card_vip_title'],
                'vip_description' => $validated['cta_card_vip_description'],
            ],
            'hero_metrics' => json_decode($validated['hero_metrics'], true),
            'mentors' => json_decode($validated['mentors'], true),
            'partners' => json_decode($validated['partners'], true),
            'opportunities' => json_decode($validated['opportunities'], true),
            'insights' => json_decode($validated['insights'], true),
        ]);

        return redirect()
            ->route('master.opportunities.edit')
            ->with('success', 'A tela de Oportunidades Prime foi atualizada com sucesso.');
    }
}
