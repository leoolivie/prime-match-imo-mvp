<?php

namespace App\Http\Controllers;

use App\Models\FeaturedProperty;
use App\Support\Format;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PrimePropertyController extends Controller
{
    public function show(string $slug)
    {
        if (is_numeric($slug)) {
            $property = FeaturedProperty::findOrFail((int) $slug);
        } elseif (Schema::hasColumn((new FeaturedProperty)->getTable(), 'slug')) {
            $property = FeaturedProperty::where('slug', $slug)->firstOrFail();
        } else {
            abort(404);
        }

        $gallery = collect($property->galleryUrls());
        $hero = $property->hero_image_url ?? null;
        if ($hero) {
            $gallery = $gallery->prepend($hero)->unique();
        }

        $priceFormatted = $property->price_formatted ?? ($property->price ? Format::currency($property->price) : null);

        return view('properties.show-prime', [
            'property' => $property,
            'galleryImages' => $gallery,
            'priceFormatted' => $priceFormatted,
        ]);
    }
}
