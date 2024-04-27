<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed|null $description
 * @property mixed|null $section
 * @property mixed|null $teacher
 * @property mixed|null $place
 * @property mixed|null $start_time
 * @property mixed|null $end_time
 * @property mixed|null $start_date
 * @property mixed|null $capacity
 * @property mixed|null $day_of_week
 * @property mixed|null $characteristics
 * @property mixed|null $poster
 * @property mixed|null $status
 * @property mixed|null $type
 */
class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        dd($this->with['user_id']);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this?->description,
            'start_time' => $this?->start_time,
            'end_time' => $this?->end_time,
            'start_date' => $this?->start_date,
            'capacity' => $this->capacity,
            'day_of_week' => $this->day_of_week,
            'characteristics' => $this?->characteristics,
            'poster' => $this?->poster,
            'status' => $this?->status,
            'type' => $this?->type,
            'teacher' => new TeacherResource($this?->teacher),
            'place' => [
                'title' => $this?->place->title,
                'address' => $this?->place->address,
            ],
            'students' => StudentResource::collection($this->students),
            'is_available' => $this->is_available??false
            //'students' => StudentResource::collection($this->groupStudents($request->group)),
            //
        ];
    }



}
