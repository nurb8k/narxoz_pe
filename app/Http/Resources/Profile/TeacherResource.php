<?php

namespace App\Http\Resources\Profile;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed|null $id
 */
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
            'id' => $this->id,
            'user_identifier' => $this->user_identifier,
            'email' => $this->user?->email,
            'name' => $this->user?->name,
            'surname' => $this->user->surname,
            'middle_name' => $this->user?->middle_name,
            'avatar' => asset($this->user->avatar),
            'lfk' => false,
            'user_type' => $this->user_type,
        ];
    }
}
