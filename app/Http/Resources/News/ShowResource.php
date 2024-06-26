<?php

namespace App\Http\Resources\News;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'title' => $this?->title,
            'description' => $this?->description,
            'sections' => $this?->sections->pluck('title'),
            'image' => asset('storage/' . $this->image),
            'created_at' => $this?->created_at?->diffForHumans(),
        ];
    }
}
