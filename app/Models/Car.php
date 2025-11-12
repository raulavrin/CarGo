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

        // If the image is already a full URL (for backward compatibility)
        if (Str::startsWith($this->image, ['http://', 'https://', '//'])) {
            return $this->image;
        }

        // If the image starts with uploads/, it's a local upload
        if (Str::startsWith($this->image, 'uploads/')) {
            return asset($this->image);
        }

        // If the image starts with site/, assume it's a public asset (backward compatibility)
        if (Str::startsWith($this->image, 'site/')) {
            return asset($this->image);
        }

        // Otherwise, treat it as a relative path in the uploads directory
        return asset('uploads/cars/' . ltrim($this->image, '/'));
    }
}