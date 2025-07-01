<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SlugService
{
    /**
     * Generate a unique slug for a given model.
     *
     * @param string $value The value to create slug from
     * @param string $model The model class (e.g., App\Models\TagName::class)
     * @param string $field The field name to check for uniqueness (default: 'slug')
     * @param int|null $exceptId ID to exclude during update (optional)
     * @return string The unique slug
     */
    public static function generateUniqueSlug(string $value, string $model, string $field = 'slug', ?int $exceptId = null): string
    {
        $value = trim($value);
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $counter = 1;

        while ($model::withTrashed()->where($field, $slug)
            ->when($exceptId, function ($query) use ($exceptId) {
                return $query->where('id', '!=', $exceptId);
            })
            ->exists()
        ) {
            // Log::info("Slug $slug exists, trying next: $originalSlug-$counter");
            $slug = $originalSlug . '-' . $counter++;
        }

        // Log::info("Final slug: $slug");
        return $slug;
    }
}
