<?php

namespace App\Http\Resources\Lesson;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**

 */
class GroupListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'group' => $this['group'],
            'lessons' => ShowAfterGroupResource::collection($this['lessons']),
        ];
    }
}
