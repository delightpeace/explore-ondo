<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'symbol', 'image_url', 'sort_order'];

    public function places(): HasMany
    {
        return $this->hasMany(Place::class, 'category', 'slug');
    }

    public function getCardClassAttribute(): string
    {
        return match ($this->slug) {
            'attractions' => 'category-culture',
            'schools' => 'category-services',
            'markets' => 'category-market',
            'food' => 'category-food',
            'stays' => 'category-stay',
            default => 'category-neutral',
        };
    }
}
