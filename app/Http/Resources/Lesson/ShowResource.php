<?php

namespace App\Http\Resources\Lesson;

use App\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources as Resources;

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
class ShowResource extends JsonResource
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
            'capacity' =>  $this->capacity,
            'color_type' => $this?->color,
            'day_of_week' => $this->day_of_week,
            'status' => $this?->status,
            'type' => $this?->type,
            'teacher' => [
                'id' => $this?->teacher->id,
                'name' => $this?->teacher->fio,
                'avatar' => $this?->teacher->avatar,
                'short_info' => $this?->teacher->short_info,
                'avg_rating' => $this?->teacher->reviews->avg('pivot.rating') ?? 0,
            ],
            'place' => $this?->place?->status .', '. $this?->place->title .', '. $this?->place->address,
            'students_count' => $this->students->count(),
            'students' => Resources\Student\StudentLessonResource::collection($this->students),
            'is_available' => $this->is_available??false
            //'students' => StudentResource::collection($this->groupStudents($request->group)),
            //
        ];
    }



}
