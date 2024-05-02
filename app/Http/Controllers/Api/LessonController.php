<?php

namespace App\Http\Controllers\Api;

use App\Enums\Week;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonSubscribeRequest;
use App\Http\Resources as Resources;
use App\Models\Lesson;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $lessons = Lesson::with(['place', 'teacher', 'section', 'students'])->get();
        return Resources\LessonResource::collection($lessons);
    }//kerek emes

    public function show(Lesson $lesson, LessonSubscribeRequest $request)
    {
        $group_date = $lesson->getGroupDate($request->lesson_date);
        $students = $lesson->groupStudents($group_date)->get();
        $lesson->students = $students;
        $lesson->setIsAvailableAttribute($request->lesson_date);
//        $lesson->is_available = $lesson->is_available($request->lesson_date);
        return Resources\Lesson\ShowResource::make($lesson);
    }



    public function my_lessons(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');
        if ($request->user()->teacher) {
            $teacherGroups = $request->user()->teacher->groups()->get();

            $groupedLessons = [];
            foreach ($teacherGroups as $group) {
                $groupValue = explode('_', $group->group);
                $date = date('d F, Y', strtotime($groupValue[2]));
//                if (Carbon::parse($groupValue[2])->lt(Carbon::now())) continue;

                $date = str_replace(
                    ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'],
                    $date
                );
                if (!isset($groupedLessons[$date])) {
                    $groupedLessons[$date] = [
                        'group' => $date,
                        'lessons' => []
                    ];
                }
                $group->lesson->studentCount = $group->lesson->groupStudents($group->group)->count();
                $group->lesson->lesson_date = $groupValue[2];
                if (!in_array($group->lesson, $groupedLessons[$date]['lessons'])) {
                    $groupedLessons[$date]['lessons'][] = $group->lesson;
                }
            }
            return response()->json(['data' => array_values($groupedLessons)]);
        }
        $studentGroups = $request->user()->student->groups()->get();
        $groupedLessons = [];
        foreach ($studentGroups as $group) {
            $groupValue = explode('_', $group->group);
            $date = Carbon::parse($groupValue[2])->format('d F, Y');
//                $asd = Carbon::parse($gr)->format('Y-m-d');
//                if (Carbon::parse($today)->greaterThanOrEqualTo(Carbon::parse($groupValue[2]))) continue;
            $date = str_replace(
                ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'],
                $date
            );
            if (!isset($groupedLessons[$date])) {
                $groupedLessons[$date] = [
                    'group' => $date,
                    'lessons' => []
                ];
            }
            $group->lesson->studentCount = $group->lesson->groupStudents($group->group)->count();
            $group->lesson->lesson_date = $groupValue[2];
            if (!in_array($group->lesson, $groupedLessons[$date]['lessons'])) {
                $groupedLessons[$date]['lessons'][] = $group->lesson;
            }
        }
//        return response()->json(['data' => array_values($groupedLessons)]);
//        dd(Resources\Lesson\GroupListResource::collection(array_values($groupedLessons)));
        return response()->json(['data' => Resources\Lesson\GroupListResource::collection(array_values($groupedLessons))]);

//        $student = auth()->user()->student;
//        $lessons = $student->lessons()->with(['teacher', 'section', 'students'])->get();
//        return Resources\Lesson\MyLessonResource::collection($lessons);
    }

    public function subscribe(Lesson $lesson, LessonSubscribeRequest $request)
    {
        if (!$lesson->is_available($request->lesson_date)) {
            return response()->json(['success' => false, 'message' => 'The lesson is not available'], 400);
        }
        $group_date = $lesson->getGroupDate($request->lesson_date);
        $student = $request->user()->student;

        $studentsCount = $lesson->groupStudents($group_date)->count();
        if ($studentsCount >= $lesson->capacity) {
            return response()->json(['success' => false, 'message' => 'The lesson is full'], 400);
        }

        if ($lesson->students()->where('student_id', $student->id)->exists()) {
            return response()->json(['success' => false, 'message' => 'You are already subscribed to the lesson',], 400);
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
        return Resources\LessonResource::collection($lessons);
    }

}
