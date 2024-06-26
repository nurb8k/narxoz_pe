<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'students_attendance' => 'required|array',
            'students_attendance.*.student_id' => 'required|numeric',
            'students_attendance.*.attendance_type' => 'required|string|in:waiting,attended,missed',
            'lesson_date' => 'required|date',//waiting,attended,missed
        ];
    }
}
