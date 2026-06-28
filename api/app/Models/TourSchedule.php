<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourSchedule extends Model
{
    protected $fillable = [
        'tour_package_id',
        'start_date',
        'end_date',
        'quota'
    ];

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }
}
