<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed|null $user_identifier
 * @property mixed|null $id
 * @property mixed|null $user
 * @property mixed|null $status
 * @property mixed|null $attendance_count
 * @property mixed|null $fio
 */
class StudentResource extends JsonResource
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
            'full_name' => $this?->fio,
            'user_identifier' => $this?->user_identifier,
            'email' => $this?->user?->email,
            'avatar' => $this?->user?->avatar,
//            'gpa' => $this?->gpa,
//            'degree' => $this?->degree,
//            'group' => $this?->group,
//            'course_year' => $this?->cource_year,
//            'gender' => $this?->gender,
            'attendance_count' => $this?->attendance_count,
        ];
    }
}
