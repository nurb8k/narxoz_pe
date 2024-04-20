<?php

namespace App\Http\Controllers\Api;

use App\Enums\Week;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonSubscribeRequest;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;

use App\Models\Subscription;
use Carbon\Carbon;

class LessonController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $lessons = Lesson::with(['place', 'teacher', 'section', 'students'])->get();
        return LessonResource::collection($lessons);
    }

    public function show(Lesson $lesson, LessonSubscribeRequest $request)
    {
        $group_date = $lesson->getGroupDate($request->lesson_date);
        $students = $lesson->groupStudents($group_date)->get();
        $lesson->students = $students;
        $lesson->setIsAvailableAttribute($request->lesson_date);
//        $lesson->is_available = $lesson->is_available($request->lesson_date);

        return LessonResource::make($lesson);

    }

    public function my_lessons()
    {
        $student = auth()->user()->student;
        $lessons = $student->lessons()->with(['place', 'teacher', 'section', 'students'])->get();

        return LessonResource::collection($lessons);
    }

    public function subscribe(Lesson $lesson, LessonSubscribeRequest $request)
    {
        if (!$lesson->is_available($request->lesson_date)) {
            return response()->json(['message' => 'The lesson is not available'], 400);
        }
        $group_date = $lesson->getGroupDate($request->lesson_date);
        $student = $request->user()->student;

        $studentsCount = $lesson->groupStudents($group_date)->count();
        if ($studentsCount >= $lesson->capacity) {
            return response()->json(['message' => 'The lesson is full'], 400);
        }

        $lesson->students()->attach($student, ['group' => $group_date, 'attendance_type' => 'waiting']);

        return response()->json(['message' => 'You have successfully subscribed to the lesson']);
    }

    public function unsubscribe(Lesson $lesson, LessonSubscribeRequest $request)
    {
        $group_date = $lesson->getGroupDate($request->lesson_date);
        $student = $request->user()->student;

        $lesson->students()->detach($student, ['group' => $group_date]);

        return response()->json(['message' => 'You have successfully unsubscribed from the lesson']);

    }

    public function getByDate(LessonSubscribeRequest $request)
    {

        $weekDay = Carbon::parse($request->lesson_date)->dayOfWeek;
        $weekDay = Week::getWeekDay($weekDay);
        $lessons = Lesson::where('day_of_week', $weekDay)->with(['place', 'teacher', 'section', 'students'])->get();
        return LessonResource::collection($lessons);
    }

}
