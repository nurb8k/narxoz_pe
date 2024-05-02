<?php

namespace App\Http\Resources\News;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed|null $id
 * @property mixed|null $title
 * @property mixed|null $sections
 * @property mixed|null $image
 * @property mixed|null $created_at
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
            'title' => $this?->title,
            'sections' => $this?->sections->pluck('title'),
            'image' => asset('storage/' . $this->image),
            'created_at' => $this?->created_at?->diffForHumans(),
        ];
    }
}
