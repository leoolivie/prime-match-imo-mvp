<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'city',
        'state',
        'price',
        'area_m2',
        'bedrooms',
        'year_built',
        'parking_spaces',
        'status',
        'short_description',
        'description',
        'display_order',
        'hero_image_path',
        'gallery_images',
        'video_url',
        'cta_view_url',
        'cta_concierge_url',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'area_m2' => 'decimal:2',
        'gallery_images' => 'array',
        'bedrooms' => 'integer',
        'parking_spaces' => 'integer',
        'year_built' => 'integer',
    ];

    protected function heroImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value, array $attributes) => $attributes['hero_image_path']
                ? asset('storage/' . $attributes['hero_image_path'])
                : asset('images/placeholders/luxury-property.svg')
        );
    }

    public function galleryUrls(): array
    {
        $images = $this->gallery_images ?? [];

        return collect($images)
            ->filter()
            ->map(function ($path) {
                if (filter_var($path, FILTER_VALIDATE_URL)) {
                    return $path;
                }

                return asset('storage/' . $path);
            })
            ->values()
            ->all();
    }
}
