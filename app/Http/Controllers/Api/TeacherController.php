<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\Teacher as Teacher;
use App\Http\Resources\TeacherResource;
use App\Models as Models;
use Illuminate\Http\Request;

class TeacherController extends \App\Http\Controllers\Controller
{

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $teachers = Models\Teacher::with(['user', 'reviews'])->get();
        return Teacher\ListResource::collection($teachers);
    }

    public function show(Models\Teacher $teacher): Teacher\ShowResource
    {
        $teacher->load(['user', 'reviews']);
        return Teacher\ShowResource::make($teacher);
    }

    public function attendance(Models\Lesson $lesson, AttendanceRequest $request): \Illuminate\Http\JsonResponse
    {
        //waiting,attended,missed //08:00:00_friday_2022-04-13

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
//here need add logic update attendance_count +1 when teacher set attendance_type = attended
        $lesson->groupSubscriptions()->where('group', $group)->whereIn('student_id', $studentIds)->each(function ($subscription) use ($studentIds, $attendanceTypes) {
            $key = array_search($subscription->student_id, $studentIds);
            if ($key !== false) {
                $subscription->attendance_type = $attendanceTypes[$key];
                $subscription->save();
            }
        });

        return response()->json(['message' => 'Attendance was saved']);
    }

//    public function preview(Models\Teacher $teacher,Request $request)
//    {
//        $student = auth()->user()->student;
//        //i need check if student already has review for this teacher
//        $checkReview = $student->reviews()->where('teacher_id', $teacher->id)->exists();
//        if ($checkReview) {
//            return response()->json(['error' => 'You have already reviewed this teacher'], 400);
//        }
//        //i need check student this lessons getted attendance_type = attended
//        $checkAttendance = $student->lessons()->where('teacher_id', $teacher->id)->where('attendance_type', 'attended')->exists();
//        dd($checkAttendance);
//        $student->reviews()->attach($teacher, ['rating' => $request->rating, 'message' => $request->message]);
//
//        return response()->json(['message' => 'Successfully added review in '.$teacher->user->name. ' ' . $teacher->user->surname.' '. $request->rating.' rating']);
//    }
}
