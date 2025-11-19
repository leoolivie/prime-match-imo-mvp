@extends('layouts.app')

@section('title', 'Editar Imóvel Prime')

@section('content')
@php
    use App\Support\ConciergeLink;
    use Illuminate\Support\Facades\Storage;
@endphp

<div class="py-12">
    <div class="lux-container max-w-4xl space-y-8">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <span class="lux-badge-gold">Editar imóvel</span>
                <h1 class="font-poppins text-3xl font-semibold text-white">{{ $property->title }}</h1>
                <p class="text-sm text-white/60">Atualize dados e materiais. Destaques premium são curados pelo time Master e refletem automaticamente após publicação.</p>
            </div>
            <a href="{{ ConciergeLink::forBusinessmanSupport($property) }}" target="_blank" rel="noopener" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Concierge</a>
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

            <form action="{{ route('businessman.property.update', $property) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                @php
                    $rawPriceValue = old('price', $property->price);
                    $priceInputValue = '';
                    if ($rawPriceValue !== null && $rawPriceValue !== '') {
                        $digits = preg_replace('/\D/', '', (string) $rawPriceValue);
                        $priceInputValue = $digits !== '' ? number_format((int) $digits, 0, '', '.') : '';
                    }
                @endphp
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Título</label>
                        <input name="title" value="{{ old('title', $property->title) }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Cidade</label>
                        <input name="city" value="{{ old('city', $property->city) }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Estado</label>
                        <input name="state" value="{{ old('state', $property->state) }}" required maxlength="2" class="mt-2 w-full uppercase rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Endereço</label>
                        <input name="address" value="{{ old('address', $property->address) }}" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">CEP</label>
                        <input name="zip_code" value="{{ old('zip_code', $property->zip_code) }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Tipo</label>
                        <select name="type" class="mt-2 w-full rounded-2xl border border-white/10 bg-white px-4 py-3 text-sm text-black focus:border-lux-gold focus:outline-none">
                            @foreach(['apartment' => 'Apartamento', 'house' => 'Casa', 'commercial' => 'Comercial', 'land' => 'Terreno', 'other' => 'Outro'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('type', $property->type) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Transação</label>
                        <select name="transaction_type" class="mt-2 w-full rounded-2xl border border-white/10 bg-white px-4 py-3 text-sm text-black focus:border-lux-gold focus:outline-none">
                            <option value="sale" @selected(old('transaction_type', $property->transaction_type) === 'sale')>Venda</option>
                            <option value="rent" @selected(old('transaction_type', $property->transaction_type) === 'rent')>Locação</option>
                            <option value="both" @selected(old('transaction_type', $property->transaction_type) === 'both')>Venda ou locação</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Valor</label>
                        <input type="text" name="price" value="{{ $priceInputValue }}" required inputmode="numeric" pattern="[0-9\.]*" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" placeholder="200.000.000" data-price-input />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Metragem (m²)</label>
                        <input type="number" name="area" value="{{ old('area', $property->area) }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Quartos</label>
                        <input type="number" name="bedrooms" value="{{ old('bedrooms', $property->bedrooms) }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Suítes</label>
                        <input type="number" name="bathrooms" value="{{ old('bathrooms', $property->bathrooms) }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Vagas</label>
                        <input type="number" name="parking" value="{{ old('parking', $property->features['vagas'] ?? null) }}" min="0" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Ano de construção</label>
                        <input type="number" name="year_built" value="{{ old('year_built', $property->features['ano'] ?? null) }}" min="1800" max="{{ now()->year }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Status</label>
                        <select name="status" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">
                            @foreach(['available' => 'Disponível', 'reserved' => 'Reservado', 'sold' => 'Vendido', 'rented' => 'Locado'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('status', $property->status) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        <input type="checkbox" name="active" value="1" id="active" class="h-4 w-4 rounded border-white/20 bg-transparent text-lux-gold focus:ring-lux-gold" @checked(old('active', $property->active)) />
                        <label for="active" class="text-sm text-white/70">Imóvel ativo na vitrine</label>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white/70">
                        <p class="font-medium text-white">Destaques prime</p>
                        <p class="mt-1 text-white/60">Somente o Master pode promover imóveis para a vitrine destaque. O concierge analisará imóveis publicados para oportunidades especiais.</p>
                    </div>
                </div>

                <div>
                    <label class="text-xs uppercase tracking-[0.3em] text-white/50">Descrição</label>
                    <textarea name="description" rows="5" required class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none">{{ old('description', $property->description) }}</textarea>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Adicionar novas fotos</label>
                        <input type="file" name="images[]" accept="image/*" multiple class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                        @if($property->images->count())
                            <div class="mt-3 grid grid-cols-3 gap-2">
                                @foreach($property->images as $img)
                                    <img src="{{ '/public/' . ltrim($property->primaryImage->path, '/') }}" alt="Foto atual" class="h-24 w-full rounded-xl object-cover" />
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div>
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Vídeo</label>
                        <input type="file" name="video" accept="video/*" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                        @if($property->video_url)
                            <p class="mt-2 text-xs text-white/50">Vídeo atual armazenado (substitua para atualizar).</p>
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs uppercase tracking-[0.3em] text-white/50">Matrícula (privada)</label>
                        <input name="registration_number" value="{{ old('registration_number', $property->registration_number) }}" class="mt-2 w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-lux-gold focus:outline-none" />
                    </div>
                </div>

                <div class="flex flex-wrap justify-end gap-3">
                    <a href="{{ route('businessman.properties') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Cancelar</a>
                    <button type="submit" name="action" value="save" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Salvar</button>
                    <button type="submit" name="action" value="preview" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Pré-visualizar</button>
                    <button type="submit" name="action" value="publish" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Publicar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
