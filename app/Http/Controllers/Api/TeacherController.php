<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Lesson;

class TeacherController extends \App\Http\Controllers\Controller
{

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $teachers = \App\Models\Teacher::with(['user', 'reviews'])->get();
        return TeacherResource::collection($teachers);
    }

    public function show(\App\Models\Teacher $teacher): TeacherResource
    {
        $teacher->load(['user', 'reviews']);
        return new TeacherResource($teacher);
    }

    public function attendance(Lesson $lesson, AttendanceRequest $request)
    {
        //waiting,attended,missed //08:00:00_friday_2022-04-13

        if (!$lesson) {
            return response()->json(['error' => 'Lesson not found'], 404);
        }

        $group = $lesson->getGroupDate($request->lesson_date);

        $checkExistGroup = $lesson->groupSubscriptions()->where('group', $group)->exists();
        if (!$checkExistGroup) {
            return response()->json(['error' => 'Group not found for specified date'], 404);
        }

//        if ($lesson->teacher_id !== auth()->user()->teacher->id) {
//            return response()->json(['error' => 'You are not a teacher of this lesson'], 403);
//        }

        $studentIds = array_column($request->students_attendance, 'student_id');
        $attendanceTypes = array_column($request->students_attendance, 'attendance_type');

        $lesson->groupSubscriptions()->where('group', $group)->whereIn('student_id', $studentIds)->each(function ($subscription) use ($studentIds, $attendanceTypes) {
            $key = array_search($subscription->student_id, $studentIds);
            if ($key !== false) {
                $subscription->attendance_type = $attendanceTypes[$key];
                $subscription->save();
            }
        });

        return response()->json(['message' => 'Attendance was saved']);
    }
}
