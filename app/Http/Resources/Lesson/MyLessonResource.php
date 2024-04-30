<?php

namespace App\Http\Resources\Lesson;

use App\Http\Resources\StudentResource;
use App\Http\Resources\TeacherResource;
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
class MyLessonResource extends JsonResource
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
            'start_time' => $this?->start_time,
            'end_time' => $this?->end_time,
            'capacity' => $this->capacity,
            'status' => $this?->status,
            'place' => $this?->place?->status .', '. $this?->place->title .', '. $this?->place->address,
            'teacher' => [
                'id' => $this?->teacher->id,
                'name' => $this?->teacher->fio,
                'avatar' => $this?->teacher->avatar,
            ],
            //'students' => StudentResource::collection($this->groupStudents($request->group)),
            //
        ];
    }



}
