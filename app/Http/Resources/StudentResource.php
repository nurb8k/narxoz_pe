<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'user_identifier' => $this?->user_identifier,
            'email' => $this?->user?->email,
            'name' => $this?->user?->name,
            'surname' => $this?->user?->surname,
            'middle_name' => $this?->user?->middle_name,
            'fcm' => $this?->user?->fcm,
            'avatar' => $this?->user?->avatar,
            'status' => $this?->status,
            'gpa' => $this?->gpa,
            'degree' => $this?->degree,
            'group' => $this?->group,
            'course_year' => $this?->cource_year,
            'gender' => $this?->gender,
            'attendance_count' => $this?->attendance_count,
        ];
    }
}
