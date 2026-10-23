<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlaceImage;

class Place extends Model
{
    protected $fillable = [
        'name',
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
