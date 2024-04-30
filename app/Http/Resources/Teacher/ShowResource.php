<?php

namespace App\Http\Resources\Teacher;

use App\Http\Resources\ReviewResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed|null $id
 * @property mixed|null $user
 * @property mixed|null $reviews
 * @property mixed|null $fio
 * @property mixed|null $short_info
 * @property mixed|null $about
 * @property mixed|null $experience_year
 */
class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this?->id,
            'full_name' => $this?->fio,
            'short_info' => $this?->short_info,
            'about' => $this?->about,
            'avatar' => $this?->user->avatar,
            'experience_year' => $this?->experience_year,
            'reviews' => ReviewResource::collection($this?->reviews),
            'avg_rating' => $this?->reviews->avg('pivot.rating'),
            'sum_review' => $this?->reviews->count(),
        ];
    }
}
