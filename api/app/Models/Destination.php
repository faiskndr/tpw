<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'province',
        'description',
        'type',
        'image_url'
    ];

    public function tourPackages()
    {
        return $this->hasMany(TourPackage::class);
    }
}
