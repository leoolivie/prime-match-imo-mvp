@extends('layouts.app')

@section('title', 'Cadastrar Imóvel Prime')

@section('content')
@php
    use App\Support\ConciergeLink;
@endphp

<div class="py-12">
    <div class="lux-container max-w-4xl">
        <div class="mb-6 flex items-center justify-between">
            <div class="space-y-2">
                <span class="lux-badge-gold">Novo imóvel</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">Adicionar imóvel à vitrine</h1>
                <p class="text-sm text-white/60">Preencha os campos principais e escolha salvar rascunho, pré-visualizar ou publicar na vitrine concierge.</p>
            </div>
            <a href="{{ ConciergeLink::forBusinessmanSupport() }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Ajuda concierge</a>
        </div>

        <div class="lux-card-dark">
            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-red-400/30 bg-red-500/15 px-4 py-3 text-sm text-red-200">
                    <ul class="list-disc space-y-1 pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('businessman.property.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @php
                    $oldPrice = old('price');
                    $priceInputValue = $oldPrice ? number_format((int) preg_replace('/\D/', '', $oldPrice), 0, '', '.') : '';
                @endphp
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Título</label>
                        <input name="title" value="{{ old('title') }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Cobertura cinematográfica nos Jardins" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Cidade</label>
                        <input name="city" value="{{ old('city') }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="São Paulo" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Estado (UF)</label>
                        <input name="state" value="{{ old('state') }}" required maxlength="2" class="mt-2 w-full uppercase rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="SP" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Endereço</label>
                        <input name="address" value="{{ old('address') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Rua, número, bairro" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">CEP</label>
                        <input name="zip_code" value="{{ old('zip_code') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="00000-000" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Tipo</label>
                        <select name="type" class="mt-2 w-full rounded-2xl border border-white/10 bg-white px-4 py-3 text-sm text-black focus:border-lux-gold focus:outline-none">
                            <option value="apartment" @selected(old('type') === 'apartment')>Apartamento</option>
                            <option value="house" @selected(old('type') === 'house')>Casa</option>
                            <option value="commercial" @selected(old('type') === 'commercial')>Comercial</option>
                            <option value="land" @selected(old('type') === 'land')>Terreno</option>
                            <option value="other" @selected(old('type') === 'other')>Outro</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Transação</label>
                        <select name="transaction_type" class="mt-2 w-full rounded-2xl border border-white/10 bg-white px-4 py-3 text-sm text-black focus:border-lux-gold focus:outline-none">
                            <option value="sale" @selected(old('transaction_type') === 'sale')>Venda</option>
                            <option value="rent" @selected(old('transaction_type') === 'rent')>Locação</option>
                            <option value="both" @selected(old('transaction_type') === 'both')>Venda ou locação</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</label>
                        <input type="text" name="price" value="{{ $priceInputValue }}" required inputmode="numeric" pattern="[0-9\.]*" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="200.000.000" data-price-input />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Metragem (m²)</label>
                        <input type="number" name="area" value="{{ old('area') }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="620" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Quartos</label>
                        <input type="number" name="bedrooms" value="{{ old('bedrooms') }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Suítes</label>
                        <input type="number" name="bathrooms" value="{{ old('bathrooms') }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Vagas</label>
                        <input type="number" name="parking" value="{{ old('parking') }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Ano de construção</label>
                        <input type="number" name="year_built" value="{{ old('year_built') }}" min="1800" max="{{ now()->year }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div class="md:col-span-2 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white/70">
                        <p class="font-medium text-white">Destaques prime</p>
                        <p class="mt-1 text-white/60">A curadoria de imóveis em destaque é exclusiva do time Master. Cadastre o imóvel normalmente e o concierge avaliará para vitrines especiais.</p>
                    </div>
                </div>

                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Descrição</label>
                    <textarea name="description" rows="5" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Conte a história do imóvel, diferenciais, retorno esperado...">{{ old('description') }}</textarea>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Fotos (até 6)</label>
                        <input type="file" name="images[]" accept="image/*" multiple class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                        <div class="mt-2">
                            <label class="text-xs uppercase tracking-[0.3em] text-white/50">Imagem de capa</label>
                            <select name="primary_image_index" class="mt-2 w-full rounded-2xl border border-white/10 bg-white px-4 py-3 text-sm text-black focus:border-lux-gold focus:outline-none">
                                @for($i = 0; $i < 6; $i++)
                                    <option value="{{ $i }}" @selected(old('primary_image_index', 0) == $i)>Imagem {{ $i + 1 }}</option>
                                @endfor
                            </select>
                            <p class="mt-2 text-[11px] uppercase tracking-[0.25em] text-white/50">A capa segue a ordem dos arquivos enviados.</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Vídeo (opcional)</label>
                        <input type="file" name="video" accept="video/*" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Matrícula (privada)</label>
                        <input name="registration_number" value="{{ old('registration_number') }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="Documento disponível mediante NDA" />
                    </div>
                </div>

                <div class="flex flex-wrap justify-end gap-3">
                    <a href="{{ route('businessman.properties') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Cancelar</a>
                    <button type="submit" name="action" value="publish" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Publicar</button>
                </div>
            </form>
</div>
</div>
</div>
@endsection

