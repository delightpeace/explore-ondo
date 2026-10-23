<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceImage extends Model
{
    protected $fillable = [
        'place_id',
        'url',
        'label',
        'path',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
