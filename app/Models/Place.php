<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'address',
        'lat',
        'lng',
    ];

    public function images()
    {
        return $this->hasMany(PlaceImage::class);
    }
}
