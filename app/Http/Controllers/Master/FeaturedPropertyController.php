<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\FeaturedProperty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FeaturedPropertyController extends Controller
{
    public function index(): View
    {
        $featuredProperties = FeaturedProperty::orderBy('display_order')->orderByDesc('created_at')->get();

        return view('master.featured-properties.index', compact('featuredProperties'));
    }

    public function create(): View
    {
        $featuredProperty = new FeaturedProperty();

        return view('master.featured-properties.create', compact('featuredProperty'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (FeaturedProperty::count() >= 16) {
            return back()->withInput()->with('error', 'Limite de 16 imóveis em destaque atingido. Exclua ou desative um destaque antes de cadastrar outro.');
        }

        $data = $this->validateRequest($request);

        $featuredProperty = new FeaturedProperty($data);
        $featuredProperty->hero_image_path = $this->handleHeroImageUpload($request);
        $featuredProperty->gallery_images = $this->handleGalleryUpload($request);
        $featuredProperty->save();

        return redirect()->route('master.featured-properties.index')
            ->with('success', 'Imóvel em destaque cadastrado com sucesso!');
    }

    public function edit(FeaturedProperty $featuredProperty): View
    {
        return view('master.featured-properties.edit', compact('featuredProperty'));
    }

    public function update(Request $request, FeaturedProperty $featuredProperty): RedirectResponse
    {
        $data = $this->validateRequest($request, $featuredProperty->id);

        $featuredProperty->fill($data);

        if ($request->boolean('remove_hero_image')) {
            $this->deleteStoredFile($featuredProperty->hero_image_path);
            $featuredProperty->hero_image_path = null;
        }

        if ($request->hasFile('hero_image')) {
            $this->deleteStoredFile($featuredProperty->hero_image_path);
            $featuredProperty->hero_image_path = $this->handleHeroImageUpload($request);
        }

        if ($request->hasFile('gallery_images')) {
            $existing = $featuredProperty->gallery_images ?? [];
            $remainingSlots = max(0, 6 - count($existing));
            $uploaded = $this->handleGalleryUpload($request, $remainingSlots);

            if (!empty($uploaded)) {
                $merged = array_values(array_filter(array_merge($existing, $uploaded)));
                $featuredProperty->gallery_images = array_slice($merged, 0, 6);
            }
        }

        if ($request->filled('remove_gallery')) {
            $indexes = collect($request->input('remove_gallery', []))
                ->map(fn ($value) => (int) $value)
                ->filter(fn ($value) => $value >= 0)
                ->unique()
                ->sortDesc();

            $gallery = $featuredProperty->gallery_images ?? [];

            foreach ($indexes as $index) {
                if (array_key_exists($index, $gallery)) {
                    $this->deleteStoredFile($gallery[$index]);
                    unset($gallery[$index]);
                }
            }

            $featuredProperty->gallery_images = array_values($gallery);
        }

        $featuredProperty->save();

        return redirect()->route('master.featured-properties.index')
            ->with('success', 'Imóvel em destaque atualizado com sucesso!');
    }

    public function destroy(FeaturedProperty $featuredProperty): RedirectResponse
    {
        $this->deleteStoredFile($featuredProperty->hero_image_path);

        foreach ($featuredProperty->gallery_images ?? [] as $path) {
            $this->deleteStoredFile($path);
        }

        $featuredProperty->delete();

        return redirect()->route('master.featured-properties.index')
            ->with('success', 'Imóvel em destaque removido com sucesso!');
    }

    protected function validateRequest(Request $request, ?int $ignoreId = null): array
    {
        $statuses = ['available', 'unavailable', 'reserved'];

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|size:2',
            'price' => 'nullable|numeric|min:0',
            'area_m2' => 'nullable|numeric|min:0',
            'bedrooms' => 'nullable|integer|min:0|max:50',
            'year_built' => 'nullable|integer|min:1800|max:' . now()->year,
            'parking_spaces' => 'nullable|integer|min:0|max:50',
            'status' => 'required|string|in:' . implode(',', $statuses),
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'display_order' => 'required|integer|min:0|max:255',
            'video_url' => 'nullable|url|max:2048',
            'cta_view_url' => 'nullable|url|max:2048',
            'cta_concierge_url' => 'nullable|url|max:2048',
            'hero_image' => 'nullable|image|max:6144',
            'gallery_images' => 'nullable|array|max:6',
            'gallery_images.*' => 'nullable|image|max:6144',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'integer',
        ]);

        return Arr::except($validated, ['hero_image', 'gallery_images', 'remove_gallery']);
    }

    protected function handleHeroImageUpload(Request $request): ?string
    {
        if (!$request->hasFile('hero_image')) {
            return null;
        }

        $file = $request->file('hero_image');
        $directory = public_path('storage/featured-properties/hero');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $filename = uniqid('hero_') . '_' . $file->getClientOriginalName();
        $file->move($directory, $filename);

        return 'storage/featured-properties/hero/' . $filename;
    }

    protected function handleGalleryUpload(Request $request, int $limit = 6): array
    {
        if (!$request->hasFile('gallery_images') || $limit <= 0) {
            return [];
        }

        $paths = [];
        $files = array_filter($request->file('gallery_images'));
        $files = array_slice($files, 0, $limit);

        foreach ($files as $file) {
            if ($file) {
                $directory = public_path('storage/featured-properties/gallery');

                if (!File::exists($directory)) {
                    File::makeDirectory($directory, 0755, true);
                }

                $filename = uniqid('gallery_') . '_' . $file->getClientOriginalName();
                $file->move($directory, $filename);

                $paths[] = 'storage/featured-properties/gallery/' . $filename;
            }
        }

        return $paths;
    }

    protected function deleteStoredFile(?string $path): void
    {
        if (!$path || filter_var($path, FILTER_VALIDATE_URL)) {
            return;
        }

        $fullPath = public_path($path);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
            return;
        }

        if (!str_starts_with($path, 'storage/')) {
            $legacyPath = public_path('storage/' . ltrim($path, '/'));

            if (File::exists($legacyPath)) {
                File::delete($legacyPath);
                return;
            }
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
