<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
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
            'email' => $this?->user->email,
            'name' => $this?->user->name,
            'surname' => $this?->user->surname,
            'middle_name' => $this?->user->middle_name,
            'fcm' => $this?->user->fcm,
            'avatar' => $this?->user->avatar,
            'short_info' => $this?->short_info,
            'about' => $this?->about,
            'experience_year' => $this?->experience_year,
            'pivot_content' => 'njadskjasd djkajdksakads',
            'pivot_syllabus' => 'dsads.pdf'
        ];
    }
}
