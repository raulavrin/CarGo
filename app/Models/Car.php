<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Car extends Model
{
    protected $table = 'car_info';
    protected $guarded = [];

    /**
     * Get the image URL for the car.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('site/img/default-car.jpg');
        }

        // If the image is already a full URL, return it as is
        if (Str::startsWith($this->image, ['http://', 'https://', '//'])) {
            return $this->image;
        }

        // If the image starts with site/, assume it's a public asset
        if (Str::startsWith($this->image, 'site/')) {
            return asset($this->image);
        }

        // Otherwise, treat it as a relative path in the site directory
        return asset('site/' . ltrim($this->image, '/'));
    }
}

