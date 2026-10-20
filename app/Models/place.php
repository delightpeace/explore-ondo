<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlaceImage;

class place extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'latitude',
        'longitude',
    ];

    public function images()
    {
        return $this->hasMany(PlaceImage::class);
    }
}
