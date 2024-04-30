<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed|null $id
 * @property mixed|null $user
 * @property mixed|null $pivot
 * @property mixed|null $created_at
 */
class ReviewResource extends JsonResource
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
            'student' => $this?->user?->name . ' ' . $this?->user?->surname,
            'avatar' => $this?->user?->avatar,
            'message' => $this?->pivot->message,
            'rating' => $this?->pivot->rating,
            'created_at' => $this?->created_at->diffForHumans(),
        ];
    }
}
