<?php

namespace App\Http\Resources\Section;

use App\Http\Resources\LessonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $description
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
            'id' => $this->id,
            'title' => $this->title,//
            'description' => $this->description,
            'image' => asset('section_image.jpeg'),
            'lessons' => LessonResource::collection($this->lessons)
        ];
    }
}
