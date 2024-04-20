<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'student' => $this?->user?->name,
            'message' => $this?->pivot->message,
            'rating' => $this?->pivot->rating,
            'created_at' => $this?->created_at->diffForHumans(),
        ];
    }
}
