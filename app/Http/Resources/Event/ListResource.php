<?php

namespace App\Http\Resources\Event;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

/**
 * @property mixed|null $id
 * @property mixed|null $title
 * @property mixed|null $start_date
 * @property mixed|null $end_date
 * @property mixed|null $description
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'start_date' => Date::parse($this->start_date)->format('H:i'),
            'end_date' => Date::parse($this->end_date)->format('H:i'),
        ];
    }
}
