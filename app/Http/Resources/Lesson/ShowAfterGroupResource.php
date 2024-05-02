<?php

namespace App\Http\Resources\Lesson;

use App\Http\Resources\StudentResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources as Resources;
use Ramsey\Uuid\Type\Integer;

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
class ShowAfterGroupResource extends JsonResource
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
            'start_time' => (string)$this->getParseDateTimeToString($this->start_time),
            'end_time' => (string)$this->getParseDateTimeToString($this->end_time),
            'capacity' =>  $this->capacity,
            'day_of_week' => $this->day_of_week,
            'status' => $this?->status,
            'type' => $this?->type,
            'is_available' => (int)$this->capacity - $this->studentCount > 0 ? (int)$this->capacity - $this->studentCount . ' мест' : 'мест нет',
            'color_type' => $this?->color,
            'teacher' => [
                'id' => $this?->teacher->id,
                'name' => $this?->teacher->user->name,
                'surname' => $this?->teacher->user->surname,
                'middle_name' => $this?->teacher->user->middle_name,
                'avatar' => asset($this?->teacher->user->avatar_path),
            ],
//            'place' => $this?->place?->status .', '. $this?->place->title .', '. $this?->place->address,
            'students_count' => $this->studentCount,
            'lesson_date' => $this->lesson_date
//            'is_available' => $this->is_available??false,
            //'students' => StudentResource::collection($this->groupStudents($request->group)),
            //
        ];
    }



}
