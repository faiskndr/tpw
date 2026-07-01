<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TourScheduleCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $result = [];
        foreach ($this->collection as $v) {
            $totalBooked = $v->bookings->count();
            $isFull = 0;

            if ($v->quota == $totalBooked) {
                $isFull = 1;
            }

            array_push($result, [
                'id' => $v->id,
                'tour_package_id' => $v->tour_package_id,
                'start_date' => $v->start_date,
                'end_date' => $v->end_date,
                'quota' => $v->quota,
                'available_quota' => $v->quota - $totalBooked,
                'joined' => $totalBooked,
                'is_full' => $isFull,
                'created_at' => $v->created_at,
                'updated_at' => $v->updated_at,

                'tour_package' => [
                    'id' => $v->tourPackage->id,
                    'destination_id' => $v->tourPackage->destination_id,
                    'title' => $v->tourPackage->title,
                    'type' => $v->tourPackage->type,
                    'location' => $v->tourPackage->destination->province,
                    'price' => $v->tourPackage->price,
                    'price_original' => $v->tourPackage->price_original,
                    'duration_days' => $v->tourPackage->duration_days,
                    'description' => $v->tourPackage->description,
                    'rating' => $v->tourPackage->rating,
                    'review_count' => $v->tourPackage->review_count,
                    'image_url' => optional($v->tourPackage->packageImageCover)->image_url,
                    'created_at' => $v->tourPackage->created_at,
                    'updated_at' => $v->tourPackage->updated_at,
                ],
            ]);
        }
        return $result;
    }
}