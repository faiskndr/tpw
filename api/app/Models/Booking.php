<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'tour_schedule_id',
        'user_id',
        'status',
    ];

    public function tourSchedule()
    {
        return $this->belongsTo(TourSchedule::class);
    }
}
