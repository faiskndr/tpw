<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageImage extends Model
{
    protected $fillable = [
        'tour_package_id',
        'image_url',
        'is_cover',
        'sort_order'
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
