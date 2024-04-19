<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;

class LessonController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $lessons = Lesson::with(['place','teacher','section','students'])->get();
        return LessonResource::collection($lessons);
    }

    public function show(Lesson $lesson): LessonResource
    {
        $lesson->load(['place','teacher','section','students']);
        return new LessonResource($lesson);
    }

    public function my_lessons()
    {
        //pass
    }



}
