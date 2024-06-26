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
 */
class ListResource extends JsonResource
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
            'name' => $this->user->name,
            'surname' => $this->user->surname,
            'middle_name' => $this->user->middle_name,
            'short_info' => $this?->short_info,
            'avatar' => asset($this->user->avatar_path),
            'avg_rating' => $this?->reviews->avg('pivot.rating')??'5',
        ];
    }
}
