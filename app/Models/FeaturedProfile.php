<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedProfile extends Model
{
    protected $fillable = [
        'type',
        'name',
        'subtitle',
        'description',
        'image_url',
        'website_url',
        'sort_order',
    ];
}
