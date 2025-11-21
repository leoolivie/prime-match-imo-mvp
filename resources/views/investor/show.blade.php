<div class="fixed inset-x-0 bottom-0 z-50 bg-[#0B0B0B]/90 backdrop-blur-xl border-t border-white/10">
    <div class="lux-container flex flex-col gap-4 py-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <span class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-2xl border border-lux-gold/50 bg-white/5 shadow-[0_0_25px_rgba(203,161,53,0.4)]">
                <img src="{{ asset('images/logo-monogram.png') }}" alt="Prime Match Imo" class="h-10 w-10 object-contain" loading="lazy">
            </span>
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-white/50">Concierge único disponível</p>
                <p class="text-lg font-semibold text-white">Fale agora com o concierge para avançar neste imóvel</p>
            </div>
        </div>
        <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Falar com o concierge</a>
    </div>
</div>
@endsection
