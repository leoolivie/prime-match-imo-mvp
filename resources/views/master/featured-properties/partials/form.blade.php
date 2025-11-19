@csrf

<div class="grid gap-10 lg:grid-cols-[1fr_0.9fr]">
    <div class="space-y-8">
        <div class="space-y-4">
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="lux-form-label" for="title">Título</label>
                    <input type="text" name="title" id="title" class="lux-input" value="{{ old('title', $featuredProperty->title) }}" required>
                </div>
                <div>
                    <label class="lux-form-label" for="display_order">Ordem de exibição</label>
                    <input type="number" name="display_order" id="display_order" class="lux-input" value="{{ old('display_order', $featuredProperty->display_order ?? 0) }}" min="0" max="255" required>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div>
                    <label class="lux-form-label" for="city">Cidade</label>
                    <input type="text" name="city" id="city" class="lux-input" value="{{ old('city', $featuredProperty->city) }}" required>
                </div>
                <div>
                    <label class="lux-form-label" for="state">Estado</label>
                    <input type="text" name="state" id="state" class="lux-input uppercase" value="{{ old('state', $featuredProperty->state) }}" maxlength="2" minlength="2" required>
                </div>
                <div>
                    <label class="lux-form-label" for="status">Status</label>
                    <select name="status" id="status" class="lux-input" required>
                        @foreach(['available' => 'Disponível', 'reserved' => 'Reservado', 'unavailable' => 'Indisponível'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $featuredProperty->status ?? 'available') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div>
                    <label class="lux-form-label" for="price">Preço</label>
                    <input type="number" step="0.01" min="0" name="price" id="price" class="lux-input" value="{{ old('price', $featuredProperty->price) }}">
                </div>
                <div>
                    <label class="lux-form-label" for="area_m2">Área (m²)</label>
                    <input type="number" step="0.01" min="0" name="area_m2" id="area_m2" class="lux-input" value="{{ old('area_m2', $featuredProperty->area_m2) }}">
                </div>
                <div>
                    <label class="lux-form-label" for="bedrooms">Quartos</label>
                    <input type="number" min="0" name="bedrooms" id="bedrooms" class="lux-input" value="{{ old('bedrooms', $featuredProperty->bedrooms) }}">
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                <div>
                    <label class="lux-form-label" for="parking_spaces">Vagas</label>
                    <input type="number" min="0" name="parking_spaces" id="parking_spaces" class="lux-input" value="{{ old('parking_spaces', $featuredProperty->parking_spaces) }}">
                </div>
                <div>
                    <label class="lux-form-label" for="year_built">Ano</label>
                    <input type="number" min="1800" max="{{ now()->year }}" name="year_built" id="year_built" class="lux-input" value="{{ old('year_built', $featuredProperty->year_built) }}">
                </div>
            </div>
            <div>
                <label class="lux-form-label" for="short_description">Descrição curta</label>
                <input type="text" name="short_description" id="short_description" class="lux-input" value="{{ old('short_description', $featuredProperty->short_description) }}" maxlength="255">
            </div>
            <div>
                <label class="lux-form-label" for="description">Descrição completa</label>
                <textarea name="description" id="description" rows="6" class="lux-input">{{ old('description', $featuredProperty->description) }}</textarea>
            </div>
        </div>

        <div class="space-y-6">
            <div>
                <label class="lux-form-label" for="hero_image">Imagem hero (principal)</label>
                <input type="file" name="hero_image" id="hero_image" class="lux-input" accept="image/*">
                <p class="mt-2 text-xs text-white/50">Imagens em alta resolução realçam o impacto da seção prime.</p>
                @if($featuredProperty->hero_image_path)
                    <div class="mt-4 space-y-3">
                        <img src="{{ $featuredProperty->hero_image_url }}" alt="Hero" class="h-48 w-full rounded-2xl object-cover">
                        <label class="inline-flex items-center gap-2 text-xs text-white/70">
                            <input type="checkbox" name="remove_hero_image" value="1" class="h-4 w-4 rounded border-white/20 bg-white/10">
                            Remover imagem atual
                        </label>
                    </div>
                @endif
            </div>

            <div>
                <label class="lux-form-label" for="gallery_images">Galeria (até 6 imagens)</label>
                <input type="file" name="gallery_images[]" id="gallery_images" class="lux-input" accept="image/*" multiple>
                <p class="mt-2 text-xs text-white/50">Você pode anexar imagens adicionais para carrosséis e destaques secundários.</p>
                @if($featuredProperty->gallery_images)
                    <div class="mt-4 grid gap-4 sm:grid-cols-3">
                        @foreach($featuredProperty->gallery_images as $index => $image)
                            @php
                                $url = filter_var($image, FILTER_VALIDATE_URL) ? $image : url('/public/' . ltrim($image, '/'));
                            @endphp
                            <label class="relative block overflow-hidden rounded-2xl border border-white/10">
                                <img src="{{ $url }}" alt="Galeria {{ $index + 1 }}" class="h-32 w-full object-cover">
                                <span class="absolute left-2 top-2 rounded-full bg-black/60 px-3 py-1 text-xs uppercase tracking-[0.3em] text-white">#{{ $index + 1 }}</span>
                                <span class="absolute inset-x-0 bottom-0 bg-black/60 px-3 py-2 text-xs text-white/70">
                                    <input type="checkbox" name="remove_gallery[]" value="{{ $index }}" class="mr-2 rounded border-white/20 bg-white/10">
                                    Remover
                                </span>
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <div>
                    <label class="lux-form-label" for="video_url">URL de vídeo (opcional)</label>
                    <input type="url" name="video_url" id="video_url" class="lux-input" value="{{ old('video_url', $featuredProperty->video_url) }}">
                </div>
                <div>
                    <label class="lux-form-label" for="cta_view_url">Link "Ver imóvel"</label>
                    <input type="url" name="cta_view_url" id="cta_view_url" class="lux-input" value="{{ old('cta_view_url', $featuredProperty->cta_view_url) }}">
                </div>
                <div>
                    <label class="lux-form-label" for="cta_concierge_url">Link "Falar com o concierge"</label>
                    <input type="url" name="cta_concierge_url" id="cta_concierge_url" class="lux-input" value="{{ old('cta_concierge_url', $featuredProperty->cta_concierge_url) }}">
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap justify-end gap-3 border-t border-white/10 pt-6">
        <a href="{{ route('master.featured-properties.index') }}" class="lux-outline-button text-xs uppercase tracking-[0.3em]">Cancelar</a>
        <button type="submit" class="lux-gold-button text-xs uppercase tracking-[0.3em]">Salvar imóvel em destaque</button>
    </div>
</div>
