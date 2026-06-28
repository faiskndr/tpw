<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    protected $fillable = [
        'destination_id',
        'title',
        'type',
        'price',
        'price_original',
        'duration_days',
        'description',
        'rating',
        'review_count'
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function tourSchedules()
    {
        return $this->hasMany(TourSchedule::class);
    }

    public function packageImages()
    {
        return $this->hasMany(PackageImage::class);
    }
}
